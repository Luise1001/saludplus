<div id="global-loader">
    <div class="logo-loader">
        <img src="{{ asset('assets/media/loader/circle_icon.png') }}" class="circle" alt="Círculo">
        <img src="{{ asset('assets/media/loader/center_icon.png') }}" class="center" alt="Centro">
    </div>
</div>


<style>
    #global-loader {
        position: fixed;
        z-index: 9999;
        width: 100vw;
        height: 100vh;
        background: white;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: opacity 0.5s ease;
        opacity: 1;
        pointer-events: all;
    }

    #global-loader.hidden {
        opacity: 0;
        pointer-events: none;
    }

    .logo-loader {
        position: relative;
        width: 150px;
        height: 150px;
    }

    .logo-loader img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .circle {
        animation: rotate-right 10s linear infinite;
    }

    .center {
        animation: rotate-left 10s linear infinite;
    }

    @keyframes rotate-right {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes rotate-left {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(-360deg);
        }
    }
</style>

<script>
    window.addEventListener('load', () => {
        const loader = document.getElementById('global-loader');
        setTimeout(() => {
            loader.classList.add('hidden');
            setTimeout(() => loader.remove(), 600);
        }, 1000);
    });
</script>
