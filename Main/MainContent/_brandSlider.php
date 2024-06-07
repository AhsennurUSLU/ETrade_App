<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<?php include __DIR__. "/../Libs/variables.php" ?> 

<style>
  .carousel-wrapper {
    position: relative;
    max-width: 1200px;
    margin: auto;
    padding: 20px;
  }

  .owl-carousel .item {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    padding: 10px;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    text-align: center;
    width: 150px;
    height: 200px;

  }

  .owl-carousel .item img {
    width: 100px;
    height: 100px;
    object-fit: contain;
    margin-bottom: 10px;
  }

  .owl-carousel .item h5 {
    font-size: 16px;
    margin: 0;
  }

  .owl-nav {
    position: absolute;
    top: 50%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    transform: translateY(-50%);
    pointer-events: none;

  }

  .owl-nav button {
    background: #333;
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 50%;
    pointer-events: all;

  }
</style>
</head>

<body>

  <div class="carousel-wrapper">

    <div class="owl-carousel owl-theme">
      <?php foreach ($brands as $brand) : ?>
        <div class="item">

          <img src="<?php echo $brand["brand-logo"] ?>" alt="<?php echo $brand["brand-name"] ?>">
          <h5><?php echo $brand["brand-name"] ?></h5>
        </div>
      <?php endforeach; ?>

    </div>

  </div>



  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
          0: {
            items: 2
          },
          600: {
            items: 4
          },
          1000: {
            items: 6
          }
        },
        navText: [
          '<i class="fas fa-chevron-left"></i>',
          '<i class="fas fa-chevron-right"></i>'
        ]
      });
    });
  </script>