new = ""

file = 'theme.scss'

files = [
    "./assets/dev/layout.scss",
    "./assets/dev/header.scss",
    "./assets/dev/footer.scss",
    "./assets/dev/wordpress.scss",
    "./assets/dev/page.scss",
    "./assets/dev/widget.scss",
    "./assets/dev/plugin.scss",
]

def get_css(css_file):
    with open(css_file, "r",encoding='utf-8') as f:
        css = f.read()
    return css


for file in files:
    new += get_css(file)

with open('./assets/css/theme.scss', "w",encoding='utf-8') as f:
    f.write(new)



# with open('functions.php','r',encoding='utf-8') as f:
#     content = f.read()
#     content = content.replace("define('JELLY_FRAME_DEBUG', true);","define('JELLY_FRAME_DEBUG', false);")

# with open('functions.php','w',encoding='utf-8') as f:
#     f.write(content)