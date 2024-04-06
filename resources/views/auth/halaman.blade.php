<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genshin Impact Wiki</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    .home {
        background: url("https://cdn.wallpapersafari.com/94/3/Y7V4l0.jpg");
        height: auto;
        width: auto;
    }

    /* Reset CSS */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Global styles */
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
    }

    header,
    footer {
        background-color: #333;
        color: #fff;
        padding: 20px;
    }

    nav ul {
        list-style-type: none;
    }

    nav ul li {
        display: inline;
        margin-right: 20px;
    }

    nav ul li a {
        color: black;
        text-decoration: none;
    }

    main {
        padding: 20px;
    }

    section {
        margin-bottom: 30px;
    }

    /* Character list styles */
    #character-list {
        list-style-type: none;
    }

    .character-item {
        border: 1px solid #ccc;
        background-color: #fff;
        margin-bottom: 10px;
        padding: 10px;
    }

    .character-item:hover {
        background-color: #f9f9f9;
    }

    .navi {
        height: 50px;
        background: grey;
    }

    .navi div {
        display: inline-block;
        position: absolute;
        padding: 15px;
        font-size: 20px;
        color: white;
    }

    .navi ul {
        position: absolute;

    }

    .navi ul li {
        display: inline-block;
    }

    .navi ul li a {
        color: white;
        padding: 5px;
    }


    #p{color: purple;}
    #bl{color: black;}

    #gr {
        color: white;
    }
</style>

<body class="home">
    <header>
        <h1>Genshin Impact Wiki</h1>
    </header>
    <nav>
        <ul>
            <li><a href="#">Karakter</a></li>
            <li><a href="#">Senjata</a></li>
            <li><a href="#">Item</a></li>
            <!-- Tambahkan halaman lain di sini -->
        </ul>
    </nav>
    <main>
        <section id="characters">
            <h2>Karakter</h2>
            <ul id="character-list">
                <!-- Daftar karakter akan ditampilkan di sini -->
            </ul>
        </section>
    </main>
    <footer>
        <p>&copy; Genshin Impact Wiki</p>
    </footer>
    <script>
        // Ambil daftar karakter dari server atau hardcode di sini
        const characters = [
            { name: 'Traveler (Anemo)', element: 'Anemo' },
            { name: 'Jean', element: 'Anemo' },
            { name: 'Diluc', element: 'Pyro' },
            { name: 'Nahida', element: 'Dendro' },
            { name: 'Keqing', element: 'Electro' },
            // Tambahkan karakter lain di sini
        ];

        // Tampilkan daftar karakter di halaman
        const characterList = document.getElementById('character-list');
        characters.forEach(character => {
            const listItem = document.createElement('li');
            listItem.classList.add('character-item');
            listItem.innerHTML = `
                <h3>${character.name}</h3>
                <p>Element: ${character.element}</p>
            `;
            characterList.appendChild(listItem);
        });
    </script>
   
    </div>

    <br />

    </div>

    <div style="font-size: 100%; text-align: left; color: white;">


        <p>
            <b class="p">Keqing</b> (Chinese: 刻晴 <em>Kèqíng</em>) <br />
            is a playable <b class="p">Electro</b> character in Genshin Impact.
        </p>

    </div>
    <br />
    <div>
        <p style="text-align: left; font-size: 120%;">As the Yuheng of the <em>Liyue Qixing,</em>she is someone who
            seeks her own answers<br />
            instead of idly letting chaos run amok in <em>Liyue</em>. She chooses her own path with<br />
            her own power and ability, instead of letting the gods determine her fate.</strong></p>
    </div>

    <div>
        <table border="1" border-="collapse" align="right">
            <caption style="color: white;">---Character Information---</caption>
            <tr style="width: 20%;height: 20%;">
                <th colspan="3" style="background-color: goldenrod;">
                    <center>
                        <p style="color: black; font-size: 100%;">Keqing</p>
                    </center>
                </th>
            </tr>

            <tr>
                <td colspan="3">
                    <p style="color: goldenrod; text-align: center;">Driving Thunder</p>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <img src="https://static.wikia.nocookie.net/gensin-impact/images/6/64/Keqing_Card.png" height="500"
                        width="300">
                </td>
            </tr>
            <tr>
                <td>
                    <b>
                        <p style="text-align: center;">Quality</p>
                    </b>
                    <center><img src="https://static.wikia.nocookie.net/gensin-impact/images/2/2b/Icon_5_Stars.png"
                            width="63" height="16">
                </td>
                <td>
                    <b>
                        <center>
                            <p style="color: goldenrod; text-align: center;">Weapon</p>
                    </b><img align="center"
                        src="https://static.wikia.nocookie.net/gensin-impact/images/9/95/Weapon-class-sword-icon.png"
                        width="20" height="20"><strong
                        style="color: goldenrod; text-align: right; font-size: small;">Sword</strong></center>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="color: goldenrod; text-align: center; "><b>Element</b>
                        <center><img align="center"
                                src="https://static.wikia.nocookie.net/gensin-impact/images/f/ff/Element_Electro.svg"
                                width="20" height="20"><strong
                                style="color: purple; text-align: right;">Electro</strong>
                    </p>
                    </center>
                </td>
                <td>
                    <center>
                        <p style="color: goldenrod; font-size: 100%;"><b>Model Type</b><br /><br /><strong
                                style="color: goldenrod; font-size: small;">Medium Female</strong></p>
                    </center>
                </td>
            </tr>
            <div>
                <tr>
                    <td colspan="3">
                        <div class="navi">
                            <ul>
                                /t<li><a href="#">Bio</a></li>
                                <li><a href="./Family">Family</a></li>
                                <li><a href="./Voice Actor">Voice Actor</a></li>
                            </ul>
                        </div>
                    </td>
                <tr>
                    <th>
                        <p><b>Birthday</b></p>
                        </td>
                    <td>
                        <p><b>November 20th</b></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Constellation</b></p>
                    </td>
                    <td>
                        <p>Trulla Cementarri</p>
                    </td>
                </tr>
                <p id="Nahida"></p>
                </tr>
            </div>
        </table>
</body>

</html>