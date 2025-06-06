<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view_home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>الصفحة الرئيسية</title>
</head>
<body>

<header>
        <nav class="navigation">
            <?php
                session_start();
                echo'<p class="name"> Welcome '.$_SESSION['login_user'].'</p>';
            ?>
             <a href="addrs.php" class="sgin"> اضافة مطعم </a>
        </nav>

        <a href="#" class="logo"> مطاعم الرياض</a>





    </header>
    <section class="title">
    <h2 id="s1"> مطاعم الشمال </h2>
    </section>

    <section class="photo">
        <div class="Restaurants"> 
            <div class="Restaurant">
                <div class="Restaurant-img">
                    <a href="https://tokyo.redro.menu/" title="للانتقال الى المطعم"><img src="imgs/TOKYO.jpg"></a>
                </div>
                <div class="Restaurant-info">
                <nav class="HoLo">
                <p class="Rest"><a href="menu/menuto.php" title="  قائمة الطعام">قائمة الطعام</a></p>
                <p class="loc"> <a href="https://maps.app.goo.gl/kYv2iatVmt1HKpit8" title="للانتقال الى الموقع">  الرياض <i class="fa-solid fa-map-location-dot"></i></a></p>
                </nav>
                    <strong class="Restaurant-title">
                    <span class="rabt"> <a href="https://tokyo.redro.menu/" title="للانتقال الى المطعم"> TOKYO</a> </span>
                    </strong>
                </div>
                
               <span class="fa fa-star checked"></span>
               <span class="fa fa-star checked"></span>
               <span class="fa fa-star checked"></span>
               <span class="fa fa-star checked"></span>
               <span class="fa fa-star checked"></span>
            </div>
            <div class="Restaurant">
            <div class="Restaurant-img">
                    <a href="https://suhailrestaurant.com/arabic" title="للانتقال الى المطعم"><img src="imgs/suhail.jpg"></a>
                </div>
                <div class="Restaurant-info">
                <nav class="HoLo">
                <p class="Rest"><a href="menu/Menusuh.php" title="  قائمة الطعام">قائمة الطعام</a></p>
                <p class="loc"> <a href="https://maps.app.goo.gl/cPJ6wUXnqWRyZq3y9" title="للانتقال الى الموقع">  الرياض <i class="fa-solid fa-map-location-dot"></i></a></p>
                </nav>
                    <strong class="Restaurant-title">
                    <span class="rabt"> <a href="https://suhailrestaurant.com/arabic" title="للانتقال الى المطعم"> Suhail</a> </span>
                    </strong>
                </div>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
            </div>
            <div class="Restaurant">
            <div class="Restaurant-img">
                    <a href="https://lusinrestaurant.com/arabic/" title="للانتقال الى المطعم"><img src="imgs/Lusin1.webp"></a>
                </div>
                <div class="Restaurant-info">
                <nav class="HoLo">
                <p class="Rest"><a href="menu/Menuln.php" title="  قائمة الطعام">قائمة الطعام</a></p>
                <p class="loc"> <a href="https://maps.app.goo.gl/foGHURnVYgi4ShHAA" title="للانتقال الى الموقع">  الرياض <i class="fa-solid fa-map-location-dot"></i></a></p>
                </nav>
                    <strong class="Restaurant-title">
                    <span class="rabt"> <a href="https://lusinrestaurant.com/arabic/" title="للانتقال الى المطعم"> Lusin</a> </span>
                    </strong>
                </div>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
            </div>
            <div class="Restaurant">
            <div class="Restaurant-img">
                    <a href="https://hungerstation.com/sa-ar/restaurant/kabsa/badr/badr/4567" title="للانتقال الى المطعم"><img src="imgs/PIATTO.jpeg"></a>
                </div>
                <div class="Restaurant-info">
                <nav class="HoLo">
                <p class="Rest"><a href="menu/MenuPT.php" title="  قائمة الطعام">قائمة الطعام</a></p>
                <p class="loc"> <a href="https://maps.app.goo.gl/5tQ2gS8gQQ2ckK22A" title="للانتقال الى الموقع">  الرياض <i class="fa-solid fa-map-location-dot"></i></a></p>
                </nav>
                    <strong class="Restaurant-title">
                    <span class="rabt"> <a href="https://hungerstation.com/sa-ar/restaurant/kabsa/badr/badr/4567" title="للانتقال الى المطعم"> PIATTO</a> </span>
                    </strong>
                </div>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
            </div>
        </div>
    </section>

    <br><br><br><br>

    <section class="title">
    <h2 id="s2"> مطاعم الشرق  </h2>
    </section>

<section class="photo">
    <div class="Restaurants"> 
        <div class="Restaurant">
        <div class="Restaurant-img">
        <a href="https://najdvillage.com/" title="للانتقال الى الموقع"><img src="imgs/najd.jpg"></a>
                </div>
                <div class="Restaurant-info">
                <nav class="HoLo">
                <p class="Rest"><a href="menu/menunj.php" title="  قائمة الطعام">قائمة الطعام</a></p>
                <p class="loc"> <a href="https://maps.app.goo.gl/jBgb3uP9CWhS3aZg8" title="للانتقال الى الموقع">  الرياض <i class="fa-solid fa-map-location-dot"></i></a></p>
                </nav>
                    <strong class="Restaurant-title">
                    <span class="rabt"> <a href="https://najdvillage.com/" title="للانتقال الى الموقع"> NajdVillage </a> </span>
                    </strong>
                </div>
                <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star "></span>
                    <span class="fa fa-star"></span>
        </div>
        <div class="Restaurant">
        <div class="Restaurant-img">
        <a href="https://sizzlerhouse.com/menu" title="للانتقال الى الموقع"><img src="imgs/sizzlerhouse.jpg"></a>
                </div>
                <div class="Restaurant-info">
                <nav class="HoLo">
                <p class="Rest"><a href="menu/menusiz.php" title="  قائمة الطعام">قائمة الطعام</a></p>
                <p class="loc"> <a href="https://maps.app.goo.gl/jFFEk9kJcSJdoo628" title="للانتقال الى الموقع">  الرياض <i class="fa-solid fa-map-location-dot"></i></a></p>
                </nav>
                    <strong class="Restaurant-title">
                    <span class="rabt"> <a href="https://sizzlerhouse.com/menu" title="للانتقال الى الموقع">SizzlerHouse </a> </span>
                    </strong>
                </div>
                <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
        </div>
        <div class="Restaurant">
        <div class="Restaurant-img">
                    <a href="https://mazameez.com.sa/" title="للانتقال الى الموقع"><img src="imgs/Mazameez.jpeg"></a>
                </div>
                <div class="Restaurant-info">
                <nav class="HoLo">
                <p class="Rest"><a href="menu/menumz.php" title="  قائمة الطعام">قائمة الطعام</a></p>
                <p class="loc"> <a href="https://maps.app.goo.gl/YxFuMsjF6khxk4sH6" title="للانتقال الى الموقع">  الرياض <i class="fa-solid fa-map-location-dot"></i></a></p>
                </nav>
                    <strong class="Restaurant-title">
                    <span class="rabt"> <a href="https://mazameez.com.sa/" title="للانتقال الى الموقع"> Mazameez</a> </span>
                    </strong>
                </div>
                <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
        </div>
        <div class="Restaurant">
        <div class="Restaurant-img">
                    <a href="https://belo.sa/belo.menu/ar/restaurant/riyadh/food.html" title="للانتقال الى الموقع"><img src="imgs/Belo.jpg"></a>
                </div>
                <div class="Restaurant-info">
                <nav class="HoLo">
                <p class="Rest"><a href="menu/menube.php" title="  قائمة الطعام">قائمة الطعام</a></p>
                <p class="loc"> <a href="https://maps.app.goo.gl/EhkbXMNLmhmfPorF8" title="للانتقال الى الموقع">  الرياض <i class="fa-solid fa-map-location-dot"></i></a></p>
                </nav>
                    <strong class="Restaurant-title">
                    <span class="rabt"> <a href="https://belo.sa/belo.menu/ar/restaurant/riyadh/food.html" title="للانتقال الى الموقع"> Belo</a> </span>
                    </strong>
                </div>
                <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
        </div>
    </div>
</section>

<br><br><br><br>

<footer>
  <br>
  <br>


  <nav class="sections">
            <a href="#">من نحن </a>
            <a href="#">الاقسام</a>
        </nav>
        <br>

        <p id="Text">منصة متخصصة في عرض أبرز المطاعم <br>في الرياض وتسهيل العثور عليها</p>
        <br><br>
        <nav class="sectionss">
            <a href="#s1"> مطاعم شمال الرياض </a>
            <a href="#s2" class="sec1"> مطاعم شرق الرياض</a>
            <br><br>
        </nav>

 
  </footer>
    
</body>
</html>