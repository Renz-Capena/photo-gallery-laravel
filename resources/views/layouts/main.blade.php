<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title')
    </title>

    {{-- bs --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    {{-- fa --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .bgImg {
          position: absolute ;
          height: 100vh ;
          width: 100vw ;
          z-index: -1 ;
          overflow: hidden ;
          top: 0;
          position: fixed 
        }
        .bgImg > img{
          height: 100vh ;
          width: 100vw ;
          object-fit: cover ;
          filter: blur(5px)
        }
      </style>
</head>
<body>
    <div class="bgImg">
        <img src="others/bg.jpg" >
    </div>

    <div class="container">

        @yield('container')

    </div>


    {{-- jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    {{-- bs --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('scripts')

    <script>
        $(function(){

            // fetch
            async function runQuotes(){
    
                const dataTmp = await fetch('https://type.fit/api/quotes');
                const data = await dataTmp.json()
    
                const randomNum = Math.floor(Math.random() * data.length) + 1
                
                $("#quotesText").html(`<i class="fa-solid fa-quote-left"></i> ${data[randomNum].text}" <i class="fa-solid fa-quote-right"></i>`)
                $("#quotesAuthor").html(`~${data[randomNum].author}`)
    
            }
    
            runQuotes();

            setInterval(() => {

                runQuotes();
                
            }, 5000);


        })
    </script>
</body>
</html>