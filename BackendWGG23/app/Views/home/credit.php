<?= $this->extend('layouts/main_layouts') ?>

<!-- css -->
<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

<style>
    * {
        padding: 0;
        margin: 0;
        /* box-sizing: border-box; */
    }

    html {
        /* width: 100vw;
        height: 100vh; */
        overflow: hidden;
    }

    body {
        overflow: hidden !important;
        width: 100vw;
        height: 100vh;
        background: url('<?= site_url("assets/images/info/plain-bg.jpg") ?>');
        backdrop-filter: blur(5px);
        background-repeat: no-repeat;
        background-size: cover;
    }

    .swiper {
        width: 50vh;
        height: 75vh;
    }

    @media screen and (max-width:700px) {
        .swiper {
            width: 60vw;
            height: 90vw;
        }
    }

    .swiper-slide {
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 18px;
        font-size: 22px;
        font-weight: bold;
        color: #fff;
        background-color: transparent;
        width: 100%;
    }

    .anggota {
        height: 90vh;
    }

    .swiper-slide img {
        width: 100%;
    }

    .flipped {
        transform: rotateY(180deg);
        border-radius: 22px;
    }

    .emoji {
        position: absolute;
        bottom: -10vh;
        font-size: 30px;
        animation: ncik 3s linear;
        animation-iteration-count: 1;
        animation-fill-mode: forwards;
        z-index: 500;
    }

    .flip-card {
        border-radius: 22px;
    }

    .flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        text-align: center;
        border-radius: 22px;
        transition: transform 0.8s;
        transform-style: preserve-3d;
        perspective: 600px;
        -webkit-perspective: 600px;
        -moz-perspective: 600px;
    }

    .flip-card-front,
    .flip-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }

    .flip-card-front {
        background-color: #bbb;
        color: black;
    }

    .flip-card-back {
        background: rgb(2, 0, 36);
        background: linear-gradient(333deg, rgba(2, 0, 36, 1) -12%, rgba(89, 0, 117, 1) 25%, rgba(255, 0, 149, 1) 89%);
        color: white;
        transform: rotateY(180deg);
    }

    @keyframes ncik {
        0% {
            bottom: 0px;
        }

        70% {
            opacity: 75%;
        }

        100% {
            transform: translateY(-200vh);
            opacity: 0%;
        }
    }
</style>
<?= $this->endsection('css'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col d-flex justify-content-center align-items-center anggota">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <?php foreach ($anggota as $a) : ?>
                        <div class="swiper-slide flip-card">
                            <div class="flip-card-inner hover">
                                <div class="flip-card-front front">
                                    <img src="<?= $a['image']; ?>" alt="">
                                </div>
                                <div class="flip-card-back d-flex flex-column justify-content-center align-items-center p-5 back">
                                    <p><?= $a['panggilan']; ?></p>
                                    <p><?= $a['jabatan']; ?></p>
                                    <p>IG: <?= $a['ig']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection('content'); ?>

<?= $this->section('script'); ?>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<script>
    const swiper = new Swiper('.swiper', {
        effect: "cards",
        rotate: true,
        grabCursor: true,
        direction: 'horizontal',
    });

    function gaweNcik(emo) {
        $(".emoji").remove();
        for (let i = 0; i < 8; i++) {
            setTimeout(function() {
                $('.row').append(`<span class='emoji' style="left:` + (Math.random() * 72 + 14) + `vw">` + emo[Math.floor(Math.random() * emo.length)] + `</span>`)
            }, 750 * i)
        };
    }

    const emojis = [
        ["👴", "💩", "🤘"], //tonyr
        ["💻", "😹", "😼"], //pand
        ["🐷", "🤌", "🤲"], //ceje
        ["🗿", "💀", "💸"], //darr,
        ["🕌", "⛪", "🛕"], //nichgun
        ["👻", "🐟", "❤️‍🔥"], //lele
        ["👊", "🎮", "😴"], //nico
        ["🐽", "☁️", "🍟"], //ebet
        ["🐓", "🎻", "🎆"], //jep
        ["😶‍🌫️", "👉🏻", "👈🏻"], //co
        ["😁", "😴", "💀"], //rel
        ["🙃", "🫠", "☠️"], //ivan
        ["🤠", "😅", "🗿"], //jov
        ["😊"], //nicf
    ]

    swiper.on('slideChange', function() {
        gaweNcik(emojis[swiper.activeIndex]);
        $(".flipped").removeClass('flipped')
    })

    gaweNcik(emojis[0]);

    $(document.body).on("click", ".swiper-slide", function() {
        if (!$(this).children('.flip-card-inner').hasClass('flipped')) {
            $(this).children('.flip-card-inner').addClass('flipped')
        } else {
            $(this).children('.flip-card-inner').removeClass('flipped')
        }
    })
</script>
<?= $this->endsection('script'); ?>