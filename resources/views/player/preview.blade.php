<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pré-visualização do Player Digital Signage</title>
    <style>
        body, html {
            margin: 0; padding: 0; background: black; height: 100vh; display: flex; justify-content: center; align-items: center; overflow: hidden;
        }
        img, video {
            max-width: 100%;
            max-height: 100vh;
        }
        .text-content {
            color: white;
            font-size: 4vw;
            text-align: center;
            width: 100%;
            padding: 2rem;
        }
        .controls {
            position: fixed;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 999;
        }
        .controls button {
            background: rgba(255,255,255,0.3);
            border: none;
            color: white;
            font-size: 1.2rem;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .controls button:hover {
            background: rgba(255,255,255,0.6);
        }
    </style>
</head>
<body>
    <div id="displayArea"></div>
    
    <div class="controls">
        <button id="prevBtn" title="Conteúdo Anterior">&#9664;</button>
        <button id="pauseBtn" title="Pausar/Reproduzir">||</button>
        <button id="nextBtn" title="Próximo Conteúdo">&#9654;</button>
    </div>

<script>
    const contents = @json($contents ?? []);
    let currentIndex = 0;
    let isPaused = false;
    let timeoutId = null;
    const displayArea = document.getElementById('displayArea');

    function showContent() {
        if (!Array.isArray(contents) || contents.length === 0) {
            displayArea.innerHTML = '<p style="color:white; font-size:2rem;">Nenhum conteúdo disponível.</p>';
            return;
        }
        clearTimeout(timeoutId);
        displayArea.innerHTML = '';
        const item = contents[currentIndex];

        if (item.type === 'image') {
            const img = document.createElement('img');
            img.src = `/storage/${item.path}`;
            displayArea.appendChild(img);
            if (!isPaused) timeoutId = setTimeout(nextContent, 7000);
        } else if (item.type === 'video') {
            const video = document.createElement('video');
            video.src = `/storage/${item.path}`;
            video.autoplay = true;
            video.muted = true;
            video.playsInline = true;
            video.onended = () => {
                if (!isPaused) nextContent();
            }
            displayArea.appendChild(video);
        } else if (item.type === 'text') {
            const div = document.createElement('div');
            div.className = 'text-content';
            div.textContent = item.text;
            displayArea.appendChild(div);
            if (!isPaused) timeoutId = setTimeout(nextContent, 7000);
        }
    }

    function nextContent() {
        currentIndex = (currentIndex + 1) % contents.length;
        showContent();
    }

    function prevContent() {
        currentIndex = (currentIndex - 1 + contents.length) % contents.length;
        showContent();
    }

    function togglePause() {
        isPaused = !isPaused;
        const pauseBtn = document.getElementById('pauseBtn');
        if (isPaused) {
            pauseBtn.textContent = '▶';
            clearTimeout(timeoutId);
            const videos = displayArea.getElementsByTagName('video');
            if (videos.length) videos[0].pause();
        } else {
            pauseBtn.textContent = '||';
            const videos = displayArea.getElementsByTagName('video');
            if (videos.length) videos[0].play();
            else showContent();
        }
    }

    document.getElementById('nextBtn').addEventListener('click', nextContent);
    document.getElementById('prevBtn').addEventListener('click', prevContent);
    document.getElementById('pauseBtn').addEventListener('click', togglePause);

    // Inicializa a exibição
    showContent();
</script>

</body>
</html>