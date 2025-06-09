<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Player Digital Signage</title>
    <style>
        body,
        html {
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

        img,
        video {
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

        #weather {
            position: fixed;
            top: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.6);
            padding: 12px 20px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.2rem;
            user-select: none;
        }

        #weather img {
            width: 40px;
            height: 40px;
        }
    </style>
</head>

<body>
    <div id="playerContent"></div>

    <div id="weather" style="display: none;">
        <img id="weather-icon" src="" alt="Ícone do clima" />
        <div>
            <div id="weather-temp"></div>
            <div id="weather-desc" style="text-transform: capitalize;"></div>
        </div>
    </div>

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
            if (item.type === 'image') {
                const img = document.createElement('img');
                img.src = `/storage/${item.path}`;
                playerContent.appendChild(img);
                setTimeout(nextContent, 7000);
            } else if (item.type === 'video') {
                const video = document.createElement('video');
                video.src = `/storage/${item.path}`;
                video.autoplay = true;
                video.muted = true;
                video.playsInline = true;
                video.onended = nextContent;
                playerContent.appendChild(video);
            } else if (item.type === 'text') {
                const div = document.createElement('div');
                div.className = 'text-content';
                div.textContent = item.text;
                playerContent.appendChild(div);
                setTimeout(nextContent, 7000);
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