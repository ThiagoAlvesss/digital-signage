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
            width: 90vw;
            height: 90vh;
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
    <div id="timer" style="position: absolute; top: 20px; right: 40px; color: #fff; font-size: 2vw; background: rgba(0,0,0,0.5); padding: 0.5em 1em; border-radius: 10px;"></div>

    <script>
        const contents = @json($contents ?? []);
        let currentIndex = 0;
        const playerContent = document.getElementById('playerContent');
        const timerDiv = document.getElementById('timer');
        let duration;

        function showContent() {
            playerContent.innerHTML = '';
            clearInterval(timerInterval);

            if (contents.length === 0) {
                playerContent.innerHTML = '<p style="color:white; font-size:2rem;">Nenhum conteúdo disponível.</p>';
                timerDiv.textContent = '';
                return;
            }

            const item = contents[currentIndex];
            let duration = (item.duration ?? 10); // segundos

            // Timer visual
            let secondsLeft = duration;
            timerDiv.textContent = `${secondsLeft}s`;
            timerInterval = setInterval(() => {
                secondsLeft--;
                timerDiv.textContent = `${secondsLeft}s`;
                if (secondsLeft <= 0) clearInterval(timerInterval);
            }, 1000);

            if (item.type === 'image') {
                const img = document.createElement('img');
                img.src = `/storage/${item.path}`;
                playerContent.appendChild(img);

                setTimeout(nextContent, duration * 1000);

            } else if (item.type === 'video') {
                const video = document.createElement('video');
                video.src = `/storage/${item.path}`;
                video.autoplay = true;
                video.muted = true;
                video.playsInline = true;

                video.onended = nextContent;

                playerContent.appendChild(video);

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