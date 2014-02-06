<!DOCTYPE HTML>
<html>
  <head>
  <link href='http://fonts.googleapis.com/css?family=Londrina+Outline' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Fredoka+One' rel='stylesheet' type='text/css'>

  
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  
  <link rel="stylesheet" media="screen" type="text/css" href="css/colorpicker.css" />
  <script type="text/javascript" src="js/colorpicker.js"></script>


    <style>
      body {
        margin: 0px;
        padding: 0px;
        font-size: 20pt;
        font-family: 'Fredoka One', cursive;
        color: #000000;
        //background-color: #dedede;
        margin: 0px auto;


      }
      
      @font-face {
        font-family: "Arialic Hollow";
        src: url(http://www.dizzybee.com.au/banners/fonts/ArialicHollow.ttf) format("truetype");
        font-family: "Scream Outline";
        src: url(http://www.dizzybee.com.au/banners/fonts/Scream_outlined.ttf) format("truetype");

      }
      
      .letter {
        //page-break-after: always;
        margin: 0px;
        padding: 0px;

      }
      
      .pagebreak {
        page-break-before: always;
        position:relative;
        float:left;
      }
      .linebreak {
        clear:right;
      }
      
      #result {
        position: relative;
        float:left;
        clear:both;
        width: 650px;
      }
      
      #canvasspace {
        float:left;
        position:relative;
        //background-color: #ff0000;
      }
      
      #canvasspace canvas {
        float:left;
        position:relative;
        //background-color: #ffff00;
        clear:both;
      }
      
      canvas {
        page-break-before: always;
        border-bottom: 1px solid #dedede;
      }
      
            
    </style>
    
    <style type="text/css" media="print">
      @page port {size: portrait;}
      @page land {size: landscape;}
     .portrait {page: port;}
     .landscape {page: land;}
     @media print {
       img { page-break-before: always; }
     }
   </style>

    <script>
    
    
    var jjlandscapemaxheight = 800;
    var portraitheight = 1555; //LEAVE at 1555
    var portraitwidth = 1100;
    var jjlandscapeheight = portraitwidth;
    var jjlandscapewidth = portraitheight;
    var jjtotheight = 0;
    var jjjpagetext = "";
    var overlap = 0;

    
function measureText(pText, pFontSize, pStyle) {
    var lDiv = document.createElement('lDiv');

    document.body.appendChild(lDiv);

    if (pStyle != null) {
        lDiv.style = pStyle;
    }
    lDiv.style.fontSize = "" + pFontSize + "px";
    lDiv.style.position = "absolute";
    lDiv.style.left = -1000;
    lDiv.style.top = -1000;

    lDiv.innerHTML = pText;

    var lResult = {
        width: lDiv.clientWidth,
        height: lDiv.clientHeight
    };

    document.body.removeChild(lDiv);
    lDiv = null;

    return lResult;
}

      var imagesinfo = new Array($(".string1").length +$(".string2").length +$(".string3").length +$(".string4").length );
      var strpos = 0;

      function processString(str, fontsize, divname) {
        var filearea = "./fonts/arialbold/";

        if (str.length != 0) {
          var i = 0;
        
          var pagetext = '';

          while (i<str.length) {
          
            var letter_value = str[i].charCodeAt(0);
            if (letter_value != 32) {
              var filename = filearea + "letter_" + letter_value + ".gif";
              imagesinfo[strpos] = new Array(3);
              imagesinfo[strpos]['filename'] = filename;
              imagesinfo[strpos]['height'] = fontsize;
              imagesinfo[strpos]['canvasname'] = divname + '_letter' + i;
              //pagetext= pagetext + '<img  id="' + imagesinfo[strpos]['canvasname'] + '" src="' + imagesinfo[strpos]['filename'] + '" height="' + imagesinfo[strpos]['height'] + 'px"/>'; 
            }

            i++;
            strpos++;
          }
        
          $("#result").append(pagetext);
        }
      }
    
    $(document).ready (function(){
    


      $(".string1").html(function(){
        processString ($(".string1").text().replace(" ", ""), <?php echo $_POST['fontsize_line1'] ?>, "line1");
     });
     
      $(".string2").html(function(){
        processString ($(".string2").text().replace(" ", ""), <?php echo $_POST['fontsize_line2'] ?>, "line2");
     });
     
      $(".string3").html(function(){
        processString ($(".string3").text().replace(" ", ""), <?php echo $_POST['fontsize_line3'] ?>, "line3");
     });
      $(".string4").html(function(){
        processString ($(".string4").text().replace(" ", ""), <?php echo $_POST['fontsize_line4'] ?>, "line4");

     });
     
 })
       function loadImages(sources, callback) {
        var images = {};
        var loadedImages = 0;
        var numImages = 0;
        // get num of sources
        for(var src in sources) {
          numImages++;
        }
        for(var src in sources) {
          images[src] = new Image();
          images[src].onload = function() {
            if(++loadedImages >= numImages) {
              callback(images);
            }
          };
          images[src].src = sources[src]['filename'];
        }
      }
    
   function createPage(pagenum) {
          var canvasDiv = document.getElementById('canvasspace');
          canvas = document.createElement('canvas');
          canvas.setAttribute('id', pagenum);
          canvas.setAttribute('width', portraitwidth);

          canvas.setAttribute('height', portraitheight);

         canvasDiv.appendChild(canvas);
         if(typeof G_vmlCanvasManager != 'undefined') {
	   canvas = G_vmlCanvasManager.initElement(canvas);
         }
         
         return(canvas.getContext("2d"));

   }
   function createLetterCanvas(letters) {
         
         loadImages(letters, function(images) {
           var xpos = 0;
           var ypos = 0;
           var prevheight = 0;
           var newheight = 0;
           context = createPage(0);

           for (i in imagesinfo) {
             scale = images[i].height/imagesinfo[i]['height'];
             var letterwidth = images[i].width/scale;
             var letterheight = imagesinfo[i]['height'];

             var newwidth = xpos + letterwidth;
             

             if (newwidth > portraitwidth) {
               ypos = ypos + prevheight;
               xpos = 0;
               newheight = ypos + imagesinfo[i]['height'];
               newwidth = 0;

             }
             
             if (newheight > portraitheight && newheight != letterheight) {
                 context = createPage(i+1);
                 xpos = 0;
                 ypos = 0;
                 newwidth = 0;
                 newheight = 0;
             }
             
             if ((letterwidth > portraitwidth) || (letterheight > portraitheight)) { //determine how many pieces to break image into
               if(letterwidth > portraitheight) { //break into 4 pieces
                 context.drawImage(images[i], 0, 0, images[i].width/2, images[i].height/2, 0, 0, letterwidth/2, letterheight/2);
                 context = createPage(i+"4a");
                 context.drawImage(images[i], images[i].width/2-overlap, 0, images[i].width/2+overlap, images[i].height/2, 0, 0, letterwidth/2+overlap, letterheight/2);
                 context = createPage(i+"4b");
                 context.drawImage(images[i], 0, images[i].height/2-overlap, images[i].width/2, images[i].height/2+overlap, 0, 0, letterwidth/2+overlap, letterheight/2);
                 context = createPage(i+"4c");
                 context.drawImage(images[i], images[i].width/2-overlap, images[i].height/2-overlap, images[i].width/2+overlap, images[i].height/2+overlap, 0, 0, letterwidth/2+overlap, letterheight/2+overlap);
                 context = createPage(i+"4d");
               
               }
               else { //break into 2 pieces after rotating
                 context.save();
                 
                 // Translate to the center point of our image
                 context.translate(letterwidth * 0.5, letterheight * 0.5);
                 // Perform the rotation
                 context.rotate(4.712);
                 // Translate back to the top left of our image
                 context.translate(-letterwidth * 0.5, -letterheight * 0.5);
                 // Finally we draw the image
                 //context.drawImage(images[i], 0, 0, images[i].width, images[i].height/2, 0, 0, letterwidth, letterheight/2);
                 alert ("iw=" + images[i].width + " ih=" +  images[i].height + " lw=" +  letterwidth + " lh=" +  letterheight + " portw=" +  portraitwidth + "  porth=" +   portraitheight);
                 yval = 500;
                 yval = portraitheight - letterheight/2;
                 context.drawImage(images[i], 0, 0, images[i].width, images[i].height/2, 0, yval, letterwidth, letterheight/2);
                 
                 context = createPage(i+"2a");
                 context.save();
                 // Translate to the center point of our image
                 context.translate(letterwidth * 0.5, letterheight * 0.5);
                 // Perform the rotation
                 context.rotate(4.712);
                 // Translate back to the top left of our image
                 context.translate(-letterwidth * 0.5, -letterheight * 0.5);
                 // Finally we draw the image
                 context.drawImage(images[i], 0, images[i].height/2, images[i].width, images[i].height/2, 0, yval, letterwidth, letterheight/2);

                 context = createPage(i+"2b");

               }
               xpos = 0;
               ypos = 0;
               newwidth = 0;
               newheight = /*portraitheight+*/1;
               prevheight = 0;
             }
             else { //do as 1 piece ie 1 page
               context.drawImage(images[i], 0, 0, images[i].width, images[i].height, xpos, ypos, letterwidth, letterheight);
               xpos = xpos + images[i].width/scale;
               prevheight = imagesinfo[i]['height'];
             }
           }
         });
         
  
   }

   $(window).load (function() {
     var totalheight = 0;
     var numpages=1;
     createLetterCanvas(imagesinfo);

   })
   
  </script>
    
  </head>
  
  <body>
  
  <?php  

      echo "<div class='string1' style='display:none;'>" . $_POST["text1_actual"] ."</div>";
      echo "<div class='string2' style='display:none;'>" . $_POST["text2_actual"] ."</div>";
      echo "<div class='string3' style='display:none;'>" . $_POST["text3_actual"] ."</div>";
      echo "<div class='string4' style='display:none;'>" . $_POST["text4_actual"] ."</div>";
      echo "<div id='result' class='". $_POST["numpagesperletter"] . "'></div>";
      echo "<div id='junk'></div>";
      echo "<div id='canvasspace'></div>";
  ?>

  </body>
</html>