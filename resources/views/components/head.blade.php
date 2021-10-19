<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        /* Stackoverflow preview fix, please ignore */
        .navbar-nav {
          flex-direction: column;
        }
        
        .nav-link {
          padding-right: .5rem !important;
          padding-left: .5rem !important;
        }
        
        /* Fixes dropdown menus placed on the right side */
        .ml-auto .dropdown-menu {
          left: auto !important;
          right: 0px;
        }
        .nav-link {
          font-size: 18px;
          font-family: 'Alternate Gothic';
          letter-spacing: 0.5px;
          color: white !important;
          text-transform: uppercase !important
        }
        .nav-link i {
          display: none
        }
    
        .navbar-brand {
          font-family: 'Futura';
          font-size: 40px;
          letter-spacing: 1px;
          font-weight: bold
        }
    
        .preloader {
          position: absolute;
          width: 100%;
          height: 100%;
          top: 0;
          left: 0;
          background-color: #FFF;
          align-content: center;
          display: flex;
          justify-content: center;
          z-index: 99999999;
        }
        body {
            
        }
      </style>
      <script>
       
        $(document).ready(function() {
            $('body').css('overflow', 'hidden');
            window.setInterval(function(){
                $('body').css('overflow', 'visible');
                $('.preloader').hide();
               
           }, 2000);
         
           $('[data-toggle="popover"]').popover();  
        });
    </script>
    </head>