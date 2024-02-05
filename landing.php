<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>landing page</title>
</head>
<body>
    <header>
        <div class="text">
        <h1>GRIMBOOK</h1>
        <p>"A room without books is like a body without a soul." - Marcus Tullius Cicero</p>
      </div>
       <div class="button">
        <a href="clogin.php"><button><b>HOME</b></button></a>
      <a href="clogin.php"><button><b>LOGIN</b></button></a>
        <a href="create.php"><button><b>CREATE</b></button></a>
       </div>
    </header>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="cont-slider">
        <section class="slider">
          <article class="slide one"><span>One</span></article>
          <article class="slide two"><span>Two</span></article>
          <article class="slide three"><span>Three</span></article>
          <article class="slide four"><span>Four</span></article>
        </section>
      </div>
      
      <style>
        @import url('https://fonts.googleapis.com/css?family=Exo:100');
      
        .cont-slider {
          position: relative;
          height: 200px;
          max-height: 100vh;
          width: auto;
          min-width: 100vw;
          margin: 0 auto;
          overflow: hidden;
        }
      
        .slider {
          animation: sliding 25s ease-out 0s infinite;
          position: absolute;
          left: 0;
          top: 0;
          width: 500%;
          height: 100%;
        }
      
        .slide {
          display: inline-block;
          width: 20%;
          height: 100%;
          background-position: center center;
          background-size: contain;
          justify-content: center;
          align-items: center;
          text-align: center;
          padding: 20px;
          background-color: #f0f0f0;
          background-size: cover;
          background-repeat: no-repeat;
          position: relative; 
        }
        .one {
          background-image: url('h1.png');
        }
      
        .two {
          background-image: url('h1.png');
        }
      
        .three {
          background-image: url('h1.png');
        }
      
        .four {
          background-image: url('h1.png');
        }
      
      
        @keyframes sliding {
          0% {
            left: 0%;
          }
          20% {
            left: 0%;
          }
          25% {
            left: -100%;
          }
          40% {
            left: -100%;
          }
          45% {
            left: -200%;
          }
          60% {
            left: -200%;
          }
          65% {
            left: -300%;
          }
          80% {
            left: -300%;
          }
          85% {
            left: -400%;
          }
          100% {
            left: -400%;
          }
        }
      </style>
    <br>
    <br>
    <section id="book-info">
        <img src="lbook.png" alt="Book Cover">
        <img src="book1.jpg" alt="Book Cover">
        <img src="book2.jpg" alt="Book Cover">
        <img src="book3.jpg" alt="Book Cover">
        <img src="lbook.png" alt="Book Cover">
        <img src="book1.jpg" alt="Book Cover">
        <img src="book2.jpg" alt="Book Cover">
        <img src="book3.jpg" alt="Book Cover">
        <div>
            <h1>SHOP YOUR DREAM BOOK</h1>
            
        </div>
        
    </section>
    <br>
    <br>
    <section id="book-info">
        <img src="lbook.png" alt="Book Cover">
        <img src="book1.jpg" alt="Book Cover">
        <img src="book2.jpg" alt="Book Cover">
        <img src="book3.jpg" alt="Book Cover">
        <img src="lbook.png" alt="Book Cover">
        <img src="book1.jpg" alt="Book Cover">
        <img src="book2.jpg" alt="Book Cover">
        <img src="book3.jpg" alt="Book Cover">
        <div>
           <h1>DISCOVER YOUR PERFECT BOOK</h1>
            
        </div>
        
    </section>
    <br>
    <br>
    <br>
    <br>
    <br>
    <section id="login">
        <h1>Get Your Copy Now!</h1>
        <ul>
           <li><a href="clogin.php"><button>LOGIN</button></a></li>
           <li><a href="create.php"><button>CREATE</button></a></li>
        </ul>
    </section>
    <br>
    <br>
    <br>
    <footer>
        <p>&copy; 2023, BURILA JOHN MELVIN CABILAO </p>
    </footer>
</body>
</html>
<style>
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    
}
header {
    background-color: black;
    color: grey;
    text-align: center;
    padding: 20px;
    position: fixed;
    top: 0;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 1;
}

.text {
    flex: 1; /* Take up remaining space in the flex container */
}

h1, p {
    margin: 0;
}

a {
    text-decoration: none;
}

.button {
    display: flex; /* Use flexbox for the button container */
}

button {
    background-color: #fff;
    color: #333;
    padding: 10px 15px;
    border: none;
    cursor: pointer;
    margin-left: 5px;
    margin-right: 5px;
}

button:hover {
    background-color: #ddd;
    color: #333;
}

#book-info {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 20px;
        background-color: #f0f0f0; 
}
    #book-info img {
        width: 150px; 
        height: 200px; 
        margin: 10px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    #book-info div {
        margin-top: 20px;
    }

    #book-info h1 {
        font-size: 24px;
        color: #333; 
    }

#book-info img:hover {
            transform: scale(1.2); 
        }

#login {
    text-align: center;
    background-color: white;
    padding: 30px;
    background-image: url('bbook.png');
    background-size: cover;
    background-position: center;
}

#login ul {
    list-style: none;
    padding: 0;
}

#login li {
    display: inline-block;
    margin: 0 10px;
}
#login button {
    background-color: #3498db;
    color: #fff;
    padding: 10px 20px;
    border: none;
    text-decoration: none;
    font-size: 16px;
    cursor: pointer;
 }
#login button:hover {
    background-color: #2980b9;
 } 
#login img {
    max-width: 100px;
    height: auto;
}
footer {
        position: fixed;
        bottom: 0;
        left: 0;
        background-color: transparent;
        color: black;
        text-align: center;
        padding: 10px;
        width: 100%;
    }
img {
            max-width: 100%;
            width: 100;
            height: auto;
            margin-top: 20px;
            height:150px;
        }
</style>
