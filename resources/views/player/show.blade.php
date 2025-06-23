<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Player Digital Signage</title>
    <style>
        body, html {
            background: black;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            color: white;
            font-family: Arial, sans-serif;
        }
        #playerContent {
            flex: 1;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        img, video {
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            object-position: center center;
        }
        .text-content {
            color: white;
            font-size: 4vw;
            text-align: center;
            width: 100%;
            padding: 2rem;
        }
    </style>
</head>
<body>

    <div id="playerContent"></div>

    <script>
        const contents = @json($contents ?? []);
        let currentIndex = 0;
        const playerContent = document.getElementById('playerContent');

        function showContent() {
            playerContent.innerHTML = '';

            if (contents.length === 0) {
                playerContent.innerHTML = '<p style="color:white; font-size:2rem;">Nenhum conteúdo disponível.</p>';
                return;
            }

            const item = contents[currentIndex];
            let duration = (item.duration ?? 10) * 1000; // Fallback para 7 segundos se não vier do banco

            if (item.type === 'image') {
                const img = document.createElement('img');
                img.src = `/storage/${item.path}`;
                playerContent.appendChild(img);

                setTimeout(nextContent, duration);

            } else if (item.type === 'video') {
                const video = document.createElement('video');
                video.src = `/storage/${item.path}`;
                video.autoplay = true;
                video.muted = true;
                video.playsInline = true;

                video.onended = nextContent;

                playerContent.appendChild(video);

                // Fallback de segurança: caso o vídeo não dispare o onended
                setTimeout(nextContent, duration);

            } else if (item.type === 'text') {
                const div = document.createElement('div');
                div.className = 'text-content';
                div.textContent = item.text;
                playerContent.appendChild(div);

                setTimeout(nextContent, duration);
            }
        }

        function nextContent() {
            currentIndex = (currentIndex + 1) % contents.length;
            showContent();
        }

        showContent();
    </script>

</body>
</html>
