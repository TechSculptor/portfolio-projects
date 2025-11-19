// email.js - AVEC L'URL ORIGINALE QUI MARCHAIT
import fs from "fs";
import path from "path";
import { fileURLToPath } from "url";
import { minify } from "html-minifier-terser";
import * as cheerio from "cheerio";
import { v4 as uuidv4 } from "uuid";
import dotenv from "dotenv";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

console.log("🚀 EMAIL TRACKING - DÉMARRAGE");

dotenv.config();

const RECIPIENTS = [
  { email: "thomasdaloz.easystore@gmail.com", name: "Thomas Daloz" },
];

const HTML_PATH = path.join(__dirname, "templates", "email-template.html");
const API_KEY = process.env.SENDINBLUE_API_KEY;
const SERVER_URL = process.env.SERVER_URL; // https://email-tracker-max.vercel.app
const FROM_EMAIL = process.env.FROM_EMAIL;
const FROM_NAME = process.env.FROM_NAME;

if (!fs.existsSync(HTML_PATH)) {
  console.error("❌ email-template.html non trouvé");
  process.exit(1);
}

console.log("✅ Toutes les vérifications passées");
console.log("🌐 SERVER_URL:", SERVER_URL);

function toPlainText(html) {
  return html.replace(/<[^>]+>/g, " ").replace(/\s+/g, " ").trim();
}

function addTrackingToEmail(html, uid, email, serverUrl, subject) {
  const $ = cheerio.load(html, { decodeEntities: false });
  
  console.log(`   📧 Tracking pour: ${email}`);

  // 🔥 UTILISER /track COMME AVANT
  // 1. PIXEL D'OUVERTURE
  const openUrl = `${serverUrl}/track?uid=${uid}&email=${email}&element=open&subject=${encodeURIComponent(subject)}`;
  console.log(`   👁️ Pixel: ${openUrl}`);
  $("body").append(`<img src="${openUrl}" width="1" height="1" style="display:none">`);

  // 2. LIENS
  $("a").each((i, el) => {
    const $el = $(el);
    const href = $el.attr("href");
    
    if (href && !href.startsWith(serverUrl) && !href.startsWith('mailto:') && !href.startsWith('#')) {
      const trackedUrl = `${serverUrl}/track?uid=${uid}&email=${email}&element=click&redirect=${encodeURIComponent(href)}`;
      $el.attr("href", trackedUrl);
      console.log(`   🔗 Lien: ${href}`);
    }
  });

  // 3. IMAGES
  $("img").each((i, el) => {
    const $el = $(el);
    const src = $el.attr("src");
    
    if (src && !src.startsWith(serverUrl)) {
      const trackedUrl = `${serverUrl}/track?uid=${uid}&email=${email}&element=image&redirect=https://max-enjoy.com`;
      $el.wrap(`<a href="${trackedUrl}"></a>`);
      console.log(`   🖼️ Image: ${src}`);
    }
  });

  return $.html();
}

async function sendEmails() {
  try {
    console.log("📖 Lecture du template...");
    const rawHtml = fs.readFileSync(HTML_PATH, "utf8");
    const htmlMin = await minify(rawHtml, { collapseWhitespace: true });

    for (const recipient of RECIPIENTS) {
      console.log(`\n🎯 Traitement: ${recipient.email}`);
      
      const uid = uuidv4();
      const subject = "Max & Enjoy : L'élégance parisienne au quotidien";
      
      const trackedHtml = addTrackingToEmail(htmlMin, uid, recipient.email, SERVER_URL, subject);
      const textAlt = toPlainText(trackedHtml);

      const emailData = {
        sender: { name: FROM_NAME, email: FROM_EMAIL },
        to: [{ email: recipient.email, name: recipient.name }],
        subject: subject,
        htmlContent: trackedHtml,
        textContent: textAlt,
      };

      console.log("   📨 Envoi à Brevo...");
      const response = await fetch("https://api.brevo.com/v3/smtp/email", {
        method: "POST",
        headers: {
          "api-key": API_KEY,
          "Content-Type": "application/json",
        },
        body: JSON.stringify(emailData),
      });

      const result = await response.json();

      if (response.ok) {
        console.log(`   ✅ EMAIL ENVOYÉ`);
        console.log(`   🔗 Test: ${SERVER_URL}/track?uid=${uid}&email=${recipient.email}&element=open`);
      } else {
        console.error(`   ❌ ÉCHEC: ${result.message}`);
      }
    }

    console.log("\n🎉 TERMINÉ");
  } catch (error) {
    console.error("💥 ERREUR:", error.message);
  }
}

sendEmails();

function doGet(e) {
  return handleTracking(e);
}

function doPost(e) {
  return handleTracking(e);
}

function handleTracking(e) {
  try {
    var params = e.parameter;
    var spreadsheet = SpreadsheetApp.openById('1kZht6hkRTr5gNI0uFBLGOv5B98fK6V6ktSS1EsySVqE');
    var timestamp = new Date();
    
    console.log('📥 Paramètres:', JSON.stringify(params));

    // 1. FEUILLE PRINCIPALE
    var mainSheet = spreadsheet.getSheetByName('Email Stats-Max-Enjoy');
    var mainRow = [
      timestamp,
      params.email || '',
      params.element || '',
      params.src || '',
      params.alt || '',
      params.uid || ''
    ];
    mainSheet.appendRow(mainRow);

    // 2. FEUILLE OUVERTURES
    if (params.element === 'open') {
      var opensSheet = spreadsheet.getSheetByName('opens');
      if (!opensSheet) {
        opensSheet = spreadsheet.insertSheet('opens');
        opensSheet.getRange('A1:F1').setValues([['timestamp', 'id', 'email', 'subject', 'url', 'userAgent']]);
      }
      var opensRow = [
        timestamp,
        params.uid || '',
        params.email || '',
        params.subject || 'Max & Enjoy',
        'email',
        params.ua || 'Unknown'
      ];
      opensSheet.appendRow(opensRow);
    }

    // 🔥 SOLUTION : TOUJOURS retourner un pixel si element=open
    if (params.element === 'open') {
      console.log('🖼️ Pixel pour ouverture');
      var pixel = ContentService.createTextOutput('<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVQYV2NgYGAAAAAEAAHIbFoAAAAASUVORK5CYII=" width="1" height="1" />');
      pixel.setMimeType(ContentService.MimeType.HTML);
      return pixel;
    }

    // Pour les autres éléments (click, image) avec redirect
    if (params.redirect) {
      console.log('🔀 Redirection pour:', params.element);
      var htmlOutput = '<html><head><meta http-equiv="refresh" content="0;url=' + params.redirect + '"></head><body></body></html>';
      return ContentService.createTextOutput(htmlOutput).setMimeType(ContentService.MimeType.HTML);
    }

    // Par défaut, retourner un pixel
    console.log('🖼️ Pixel par défaut');
    var pixel = ContentService.createTextOutput('<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVQYV2NgYGAAAAAEAAHIbFoAAAAASUVORK5CYII=" width="1" height="1" />');
    pixel.setMimeType(ContentService.MimeType.HTML);
    return pixel;
      
  } catch (error) {
    console.error('❌ Erreur:', error.toString());
    var pixel = ContentService.createTextOutput('<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVQYV2NgYGAAAAAEAAHIbFoAAAAASUVORK5CYII=" width="1" height="1" />');
    pixel.setMimeType(ContentService.MimeType.HTML);
    return pixel;
  }
}