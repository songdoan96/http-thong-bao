<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo</title>
    <style>
        body {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            padding: 1rem;
        }

        #wrap {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .line {
            width: calc(100% / 6 - 45px);
            height: 50px;
            background-color: #27ae60;
            display: flex;
            text-align: center;
            justify-content: center;
            line-height: 50px;
            color: #000;
        }

        @media only screen and (max-width: 600px) {
            .line {
                width: calc(100% / 3 - 20px);
            }
        }
    </style>
</head>

<body>
    <div id="wrap">
        <?php
        for ($i = 1; $i <= 5; $i++) { ?>
            <a class="line" target="_blank" href="chuyen.php?id=<?= $i ?>">Chuyền <?= $i ?></a>
        <?php }
        ?>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var intervalId;

            intervalId = setInterval(() => {
                notification()
            }, 1000);

            function notification() {
                fetch("services.php").then(res => res.json()).then(list => {
                    if (list.length) {
                        clearInterval(intervalId);
                        let audioFiles = [];

                        list.forEach(i => {
                            let audioName = `assets/${i.line}-${i.job}.mp3`;
                            audioFiles.push(audioName)
                        });
                        playAudio(audioFiles, 0);

                    }
                })
            }

            function playAudio(files, index) {
                if (index == files.length) {
                    setTimeout(() => {
                        intervalId = setInterval(() => {
                            notification()
                        }, 1000);
                    }, 2000)

                }
                if (index < files.length) {
                    let audio = new Audio(files[index]);
                    console.log(files[index]);
                    audio.play();
                    audio.onended = function() {
                        setTimeout(() => {
                            playAudio(files, index + 1);
                        }, 1000);
                    };
                }

            }


            // var intervalId = setInterval(function() {
            //     fetch('services.php')
            //         .then(res => res.json())
            //         .then(list => {
            //             if (list.length) {
            //                 clearInterval(intervalId);

            //                 var audioFiles = [];
            //                 list.forEach(i => {
            //                     let audioName = `assets/${i.line}-${i.job}.mp3`;
            //                     audioFiles.push(audioName)
            //                 });

            //                 function playAudio(files, index) {
            //                     if (index == files.length) {

            //                         setTimeout(() => {
            //                             location.reload();
            //                         }, 3000);

            //                     }
            //                     if (index < files.length) {
            //                         let audio = new Audio(files[index]);
            //                         audio.play();
            //                         audio.onended = function() {
            //                             setTimeout(() => {
            //                                 playAudio(files, index + 1);
            //                             }, 1000);
            //                         };
            //                     }

            //                 }
            //                 playAudio(audioFiles, 0);
            //             }
            //         })
            // }, 1000)
        })
    </script>
</body>

</html>