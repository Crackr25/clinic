
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      @php
            header('Content-Type: text/html; charset=ISO-8859-1');
      @endphp

    <title>Document</title>

    <style>

      body
      {
            font-family: "Times New Roman", Times, serif;
      }

       html{
            font-family: Arial, Helvetica, sans-serif;
    
        }
       
      .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            background-color: transparent;
      }
      
       
      table {
            border-collapse: collapse;
      }
      .text-center {
      text-align: center!important;
      }      
      .align-middle {
      vertical-align: middle!important;
      } 
      

      .text-right {
      text-align: right!important;
      }
      .text-left {
      text-align: left!important;
      }

      .border-0 {
      border: 0!important;
      }

      .border-bottom {
      border-bottom: 1px solid black!important;
      }
      .border-left {
      border-left: 1px solid black!important;
      }
      .border-top {
      border-top: 1px solid black!important;
      }

      .font-italic {
      font-style: italic!important;
      }
      img {
      width:50%;
      display: block;
      }

        footer {
                position: fixed; 
                bottom: -30px; 
                height: 50px; 
                text-align: center;
                line-height: 35px;
                font-size:8px;
            }

      .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -7.5px;
            margin-left: -7.5px;
      }
      .col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
            position: relative;
            width: 100%;
            padding-right: 7.5px;
            padding-left: 7.5px;
      }
    </style>
   
</head>
<body>
      <iframe class="doc" src="{{asset('paymentoptions/result.docx')}}"></iframe>

</body>
  
    
 
</html>
        