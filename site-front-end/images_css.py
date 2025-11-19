from PIL import Image
import os

# Dossier contenant les images PNG
input_folder = "images_css"
output_file = "css_output.txt"

# Convertion px en rem (1rem = 16px)
px_to_rem = 16

# Ouvrir le fichier de sortie
with open(output_file, "w") as f_out:
    for filename in os.listdir(input_folder):
        if filename.lower().endswith(".png"):
            file_path = os.path.join(input_folder, filename)
            with Image.open(file_path) as img:
                width_px, height_px = img.size
                width_rem = round(width_px / px_to_rem, 3)
                aspect_ratio = f"{width_px}/{height_px}"

                class_name = os.path.splitext(filename)[0]

                css = f".{class_name} {{ width: {width_rem}rem; aspect-ratio: {aspect_ratio}; }}\n"
                f_out.write(css)

print(f"CSS généré dans {output_file}")
