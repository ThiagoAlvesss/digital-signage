<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Player Digital Signage</title>
    <style>
        body, html {
            margin:0; padding:0; overflow: hidden; background: black; height: 100vh; display: flex; justify-content: center; align-items: center;
        }
        img, video {
            max-width: 100%;
            max-height: 100vh;
        }
        .text-content {
            color: white;
            font-size: 3rem;
            text-align: center;
            width: 100%;
        }
    </style>
</head>
<body>
    <div id="displayArea"></div>

    <script>
        const contents = @json($contents);
        let current = 0;
        const displayArea = document.getElementById('displayArea');

        function showContent() {
            if(contents.length === 0) {
                displayArea.innerHTML = '<p style="color:white;">Nenhum conteúdo disponível.</p>';
                return;
            }
            const item = contents[current];
            displayArea.innerHTML = '';

            if(item.type === 'image') {
                const img = document.createElement('img');
                img.src = '/storage/' + item.path;
                displayArea.appendChild(img);
            } else if(item.type === 'video') {
                const video = document.createElement('video');
                video.src = '/storage/' + item.path;
                video.autoplay = true;
                video.loop = false;
                video.muted = true;
                displayArea.appendChild(video);

                video.onended = () => {
                    nextContent();
                }
                return;
            } else if(item.type === 'text') {
                const textDiv = document.createElement('div');
                textDiv.className = 'text-content';
                textDiv.innerText = item.text;
                displayArea.appendChild(textDiv);
            }
            // avança para próximo conteúdo após 5s
            setTimeout(nextContent, 5000);
        }

        function nextContent() {
            current = (current + 1) % contents.length;
            showContent();
        }

        showContent();
    </script>
</body>
</html>