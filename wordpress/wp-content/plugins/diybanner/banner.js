

    var jumper_width = "100px";
    var jumper_height = "170px";
    var scaleval = 1.55;
    var ratio = 5*scaleval;
    //var fontratio = 23*scaleval;
    var fontratio = 29*scaleval;
    var maxfontsize = 47/scaleval;
    var minfontsize = 8/scaleval;
    var imagescale = 30;
    imagescale = 35;
    var portraitheight = 1300; 
    var portraitwidth = 1200;
    portraitheight = 1184;
    portraitwidth = 832;
   
    
    /* Image scaling */
    var imagescale = 1;
    var imageprintscale = 3;
    var maximagewidth = 190;
    var maximageheight = 300;
    /* font sizing variables */
    var a4portraitwidth = 210;
    var a4portraitheight = 297;
    var maxfontsize = 210;
    var minfontsize = 10;
    var fontstep = 10;
    /* Note: the max font size are worked out using capital W */
    var a4maxfontsize = maxfontsize;
    var a3maxfontsize = 260;
    var a0maxfontsize = 290;
    var ratio = 1;
    var scaleval = 1;
    var twopageupscale = a3maxfontsize/a4maxfontsize;
    var fourpageupscale = a0maxfontsize/a4maxfontsize;
    var fontratio = 5;
    
    /* banner sizing variables */
    var upscale;
    var maxActualWidth = 6000;
    var maxActualHeight = maxActualWidth/2;
    var maxScreenHeight = 360;
    var maxScreenWidth = 720;
    
    var overscale;
    overscale = false;
    /*
    var smallbannerscale = 10;
    var normalbannerscale = 1.3;
    var upscale = 1.3;
    var bigScale;
    var smallScale;
	bigScale = Math.round(maxScreenHeight/maxActualHeight,1);
    bigScale = 0.13;
    smallScale = 0.4;
    */
   
    var pallet = new Array ("aqua", "black", "blue", "fuchsia", "gray", "lightgray", "green", "lime", "maroon", "navy", "olive", "purple", "red", "silver", "teal", "white", "yellow", "orange");


    function printCanvas(el)  
    {  
    
      if ($('#printImages').is(':checked')) {
	      var windowContent = '<!DOCTYPE html>';
	      windowContent += '<html>'
	      windowContent += '<head><title>Print canvas</title><script>img {page-break-after:always;}</script></head>';
	      windowContent += '<body>'
	      
	      $("#images-logos canvas").each(function() {
	        this_id = $(this).attr('id');
	        if ($(this).width()*imageprintscale > portraitwidth) {
	          alert($(this).width()*imageprintscale);
	          console.log ('need to rotate image')
	        }
	        var dataUrl = document.getElementById(this_id).toDataURL(); //attempt to save base64 string to server using this var  
	        windowContent += '<img height="' + $(this).height()*imageprintscale/upscale + '" src="' + dataUrl + '">';
	      });
	      windowContent += '</body>';
	      windowContent += '</html>';
	      var printWin = window.open('','','width=340,height=260');
	      printWin.document.open();
	      printWin.document.write(windowContent);
	      printWin.document.close();
	      printWin.focus();
	      //printWin.print();
	      //printWin.close();
	     }
    }
    
    function createHelpSheet (steps) {
      var colourinfo = "<h2>Colours Used</h2>";
      colourinfo += "Colour 1: <div class='colours-used' style='background-color:"+$('#colour1 div').css('background-color')+"'></div>";
      colourinfo += "Colour 2: <div class='colours-used' style='background-color:"+$('#colour2 div').css('background-color')+"'></div>";
      $("#infoSteps").html(colourinfo + steps);
    }

   
function cloneCanvas(oldCanvas) {

    //create a new canvas
    var newCanvas = document.createElement('canvas');
    var context = newCanvas.getContext('2d');

    //apply the old canvas to the new one
    context.drawImage(oldCanvas, 0, 0);

    //return the new canvas
    return newCanvas;
}

    function convertToMM (val) {
      return (Math.round(val * ratio/100)*100);
    }

    function clearCanvas(canvasid) {
      var canvas = document.getElementById(canvasid);
      var context = canvas.getContext("2d");
      context.clearRect(0, 0, canvas.width, canvas.height);
    }
    
    function addDimensions (context, xval, yval, txt) {
      xpos = (xval/1.5)+100;
      ypos = (yval/1.5)+100;

      if (txt == null) {
        context.fillText(convertToMM(xval) + "mm x" + convertToMM(yval)+"mm", xpos,ypos);
      }
      else {
        context.fillText(txt, xpos,ypos);
      }

    }
    
    function setBackground(canvasid, choice, scale, translatePos) {
          clearCanvas(canvasid);
          clearCanvas ('infoDimensions');
          var steps = "";
          
          var canvas = document.getElementById(canvasid);
          var context = canvas.getContext("2d");
          if (scale == null) {
          	scale = 1.0;
          }
    //alert('BEFORE canvas size >> '+canvas.width);
          if (translatePos != null) {
    context.clearRect(0, 0, canvas.width, canvas.height);
    context.save();
    context.translate(translatePos.x, translatePos.y);
    }
    context.scale(scale, scale);
          var bgwidth = $("#background").width();
          var bgheight = $("#background").height();
          canvas.width = bgwidth;
          canvas.height = bgheight;
    //alert('AFTER canvas size >> '+canvas.width);
        
          infoCanvas = document.getElementById('infoCanvas');
          var infoCanvasContext = infoCanvas.getContext("2d");
          infoCanvas.width = bgwidth;
          infoCanvas.height = bgheight;
          
          infoDimensionsCanvas = document.getElementById ('infoDimensions');
          //infoDimensionsCanvas.width = bgwidth;
          //infoDimensionsCanvas.height = bgheight;
          var infoDimensionsContext = infoDimensionsCanvas.getContext("2d");
          infoDimensionsContext.font = "10pt Calibri";
			infoDimensionsContext.fillStyle = "rgba(255, 255, 255, .6)";
			infoDimensionsContext.fillRect(0, 0, infoDimensionsCanvas.width, infoDimensionsCanvas.height);        
			infoDimensionsContext.fill();
          infoDimensionsContext.fillStyle = "black";
          
          infoStepsCanvas = document.getElementById ('infoDimensions');
          var infoStepsContext = infoDimensionsCanvas.getContext("2d");
          infoStepsContext.font = "10pt Calibri";
          infoDimensionsContext.fillStyle = "black";

                
        
        switch (choice) {
          case "2v":
          context.beginPath();
          context.rect(0, 0, bgwidth, bgheight);
          context.fillStyle = $('#colour1 div').css('background-color');
          context.fill();
          context.beginPath();
          context.moveTo(0, 0);
          context.lineTo(0,canvas.height/6);
          addDimensions (infoDimensionsContext, 0,canvas.height/6);
          context.lineTo(canvas.width/2, canvas.height/2);
          addDimensions (infoDimensionsContext, canvas.width/2, canvas.height/2);
          context.lineTo(canvas.width,canvas.height/6);
          addDimensions (infoDimensionsContext, canvas.width,canvas.height/6);
          
          context.lineTo(canvas.width, 0);

          context.closePath();
          context.fillStyle = $('#colour2 div').css('background-color');;
          context.fill();

          steps += "<ol>";
          steps += "<li>Using colour1 create an area"+convertToMM($('#background').width())+" wide by "+convertToMM($('#background').height()) +" high.</li>";
          steps += "</ol>";
          
          
          break;
          
        case "2stripes-horizontal":

          var yval = 0;
          var inc = canvas.height/5;
          var loop = 0;
          
          addDimensions (infoDimensionsContext, 10,30, "Each band is "+ convertToMM(canvas.height/5)+"mm high.");
          
          while (yval < canvas.height) {
            yval = loop*inc*2;
            context.beginPath();
            context.rect(0, yval, canvas.width, inc);
            context.fillStyle = $('#colour1 div').css('background-color');
            context.fill();
          
            context.beginPath();
            context.rect(0, yval+inc, canvas.width, inc);
            context.fillStyle = $('#colour2 div').css('background-color');;
            context.fill();
            
            loop = loop + 1;

          }
          break;
          
         case "2stripes-vertical":

          var xval = 0;
          var inc = canvas.width/5;
          var loop = 0;
          
          addDimensions (infoDimensionsContext, 10,30, "Each stripe is "+ convertToMM(canvas.width/5)+"mm wide.");
          
          while (xval < canvas.width) {
            xval = loop*inc*2;
            context.beginPath();
            context.rect(xval, 0, inc, canvas.height);
            context.fillStyle = $('#colour1 div').css('background-color');
            context.fill();
          
            context.beginPath();
            context.rect(xval+inc, 0, inc, canvas.height);
            context.fillStyle = $('#colour2 div').css('background-color');;
            context.fill();
            
            loop = loop + 1;

          }
          break;

         case "2bands-vertical":

          var inc = canvas.width/4;
          
            context.beginPath();
            context.rect(0, 0, inc, canvas.height);
            context.fillStyle = $('#colour1 div').css('background-color');
            context.fill();
            addDimensions (infoDimensionsContext, 10,30, convertToMM(inc)+"mm W x "+ convertToMM(canvas.height)+"mm H");
          
            context.beginPath();
            context.rect(inc, 0, inc*2, canvas.height);
            context.fillStyle = $('#colour2 div').css('background-color');;
            context.fill();
            addDimensions (infoDimensionsContext, inc,60, convertToMM(inc*2)+"mm W x "+ convertToMM(canvas.height)+"mm H");

            context.beginPath();
            context.rect(inc*3, 0, inc, canvas.height);
            context.fillStyle = $('#colour1 div').css('background-color');
            context.fill();
            addDimensions (infoDimensionsContext, inc*3,30, convertToMM(inc)+"mm W x "+ convertToMM(canvas.height)+"mm H");
            
          break;

         case "2bands-side-vertical":

          var inc = canvas.width/7;
          
            context.beginPath();
            context.rect(0, 0, inc, canvas.height);
            context.fillStyle = $('#colour1 div').css('background-color');
            context.fill();
          
            context.beginPath();
            context.rect(inc, 0, inc, canvas.height);
            context.fillStyle = $('#colour2 div').css('background-color');
            context.fill();

            context.beginPath();
            context.rect(inc*2, 0, inc*3, canvas.height);
            context.fillStyle = $('#colour1 div').css('background-color');;
            context.fill();

            context.beginPath();
            context.rect(inc*5, 0, inc, canvas.height);
            context.fillStyle = $('#colour2 div').css('background-color');
            context.fill();

            context.beginPath();
            context.rect(inc*6, 0, inc, canvas.height);
            context.fillStyle = $('#colour1 div').css('background-color');
            context.fill();
            
          break;
          
          case "2bands-horizontal":

          var inc = canvas.height/5;
          
            context.beginPath();
            context.rect(0, 0, canvas.width, inc);
            context.fillStyle = $('#colour1 div').css('background-color');
            context.fill();
          
            context.beginPath();
            context.rect(0, inc, canvas.width, inc*3);
            context.fillStyle = $('#colour2 div').css('background-color');;
            context.fill();

            context.beginPath();
            context.rect(0, inc*4, canvas.width, inc);
            context.fillStyle = $('#colour1 div').css('background-color');
            context.fill();
            
          break;
          
         case "2bands-horizontal-thinmiddle":

          var inc = canvas.height/5;
          
            context.beginPath();
            context.rect(0, 0, canvas.width, inc*2);
            context.fillStyle = $('#colour1 div').css('background-color');
            context.fill();
          
            context.beginPath();
            context.rect(0, inc*2, canvas.width, inc);
            context.fillStyle = $('#colour2 div').css('background-color');;
            context.fill();

            context.beginPath();
            context.rect(0, inc*3, canvas.width, inc*2);
            context.fillStyle = $('#colour1 div').css('background-color');
            context.fill();
          break;
          
          case "solid":

            context.beginPath();
            context.rect(0, 0, canvas.width, canvas.height);
            context.fillStyle = $('#colour2 div').css('background-color');;
            context.fill();
          break;
          
          case "2tone":

            context.beginPath();
            context.rect(0, 0, canvas.width, canvas.height/3);
            context.fillStyle = $('#colour1 div').css('background-color');
            context.fill();
            context.beginPath();
            context.rect(0, canvas.height/3, canvas.width, canvas.height);
            context.fillStyle = $('#colour2 div').css('background-color');
            context.fill();

          break;

          case "2tone-diagonalstripe-backwards":
            
            var line_width = 30;

            context.beginPath();
            context.rect(0, 0, canvas.width, canvas.height);
            context.fillStyle = $('#colour1 div').css('background-color');
            context.fill();
            
            context.beginPath();
            context.moveTo(line_width, 0);
            context.lineTo(0, 0);
            context.lineTo(0, line_width);
            context.lineTo(canvas.width-line_width, canvas.height);
            context.lineTo(canvas.width, canvas.height);
            context.lineTo(canvas.width, canvas.height-line_width);
            //context.lineTo(canvas.width, 0);

            context.closePath();
            context.fillStyle = $('#colour2 div').css('background-color');;
            context.fill();
          break;
          
          case "2tone-diagonalstripe-forwards":
            
            var line_width = 30;

            context.beginPath();
            context.rect(0, 0, canvas.width, canvas.height);
            context.fillStyle = $('#colour1 div').css('background-color');
            context.fill();
            
            context.beginPath();
            context.moveTo(canvas.width-line_width, 0);
            context.lineTo(canvas.width, 0);
            context.lineTo(canvas.width, line_width);
            context.lineTo(line_width, canvas.height);
            context.lineTo(0, canvas.height);
            context.lineTo(0, canvas.height-line_width);
            //context.lineTo(canvas.width, 0);

            context.closePath();
            context.fillStyle = $('#colour2 div').css('background-color');;
            context.fill();
          break;
        }
          if (translatePos != null) {
          	context.restore();
          }
          createHelpSheet(steps);
        
          infoCanvasContext.drawImage(canvas,0,0,canvas.width, canvas.height, 100,100, canvas.width/1.5, canvas.height/1.5);

      };

        function addNumber() {
                element = document.getElementById("jumper-number");
          element.parentNode.removeChild(document.getElementById("jumper-number"));
          
          var canvasDiv = document.getElementById('jumper');
          canvas = document.createElement('canvas');
          canvas.setAttribute('id', 'jumper-number');
          canvas.setAttribute('width', jumper_width);

          canvas.setAttribute('height', jumper_height);

         canvasDiv.appendChild(canvas);
         if(typeof G_vmlCanvasManager != 'undefined') {
	   canvas = G_vmlCanvasManager.initElement(canvas);
         }
         
         context = canvas.getContext("2d");
         context.font = "40pt Arial";
         context.lineWidth = 4;
         context.fillStyle = "white";
         context.fill();

         context.strokeText($("#jumper1-number").val(), canvas.width/2-10, canvas.height/3*2);  
         
      }
      
      function addJumper() {
      
        function drawJumper (ctx) {
          context.beginPath();
          context.moveTo(5,165);
          context.lineTo(95, 165);
          
          context.lineTo(95, 80);
          context.quadraticCurveTo(80,40, 95,20);
          
          context.lineTo(80, 5); //shoulder
          context.lineTo(55,30); //right v
          context.lineTo(30,5); //left v
          context.lineTo(5,20); //shoulder
          context.quadraticCurveTo(25,40, 5,80);

          context.closePath();
       
        
        }
        
        $("#jumpers").append("<div id='jumper' class='jumperff'><canvas id='jumper-outline' width='"+jumper_width+"' height='"+jumper_height+"'></canvas><canvas id='jumper-number' width='"+jumper_width+"' height='"+jumper_height+"'></canvas></div>");
        
        var canvas = document.getElementById("jumper-outline");
        var context = canvas.getContext("2d");
             
             
        setBackground('jumper-outline', '2tone');
        //context.rect(0,0,30,100);
        //context.fillStyle="purple";
        //context.fill();

        context.globalCompositeOperation = 'destination-atop';



        drawJumper(context);
        context.fillStyle = 'black';
        context.fill();
        
        drawJumper(context);
        context.scale(1.5,1.5);
        context.lineWidth = 0;
        context.strokeStyle = "white";
        context.stroke();   
        
        drawJumper(context);
        addNumber();      
        
    };
    
    function changeAllBackgrounds() {
      setBackground('2v-sample', '2v');
      setBackground('2stripesh-sample', '2stripes-horizontal');
      setBackground('2stripesv-sample', '2stripes-vertical');
      setBackground('2bandsv-sample', '2bands-vertical');
      setBackground('2bandssidev-sample', '2bands-side-vertical');

      setBackground('2bandsh-sample', '2bands-horizontal');
      setBackground('2bandshthinmiddle-sample', '2bands-horizontal-thinmiddle');
      setBackground('solid-sample', 'solid');
      setBackground('2tone-sample', '2tone');
      setBackground('2tonebackdiagonal-sample', '2tone-diagonalstripe-backwards');
      setBackground('2toneforwarddiagonal-sample', '2tone-diagonalstripe-forwards');
      
      setBackground('background', $("#background-fillsettings li.selected canvas").attr("value"));

    }
    
    function addImagetoCanvas (logo, this_id) {
    
      var canvasDiv = document.getElementById('image_'+this_id);
      canvas = document.createElement('canvas');
      canvas.setAttribute('id', 'canvas_'+this_id);
      canvasDiv.appendChild(canvas);
      
      var context = canvas.getContext("2d");
      var imageObj = new Image();
      imageObj.src = logo;
      imageObj.onload = function() {
        context.drawImage(imageObj, 0, 0, this.width*upscale, this.height*upscale);
      };
     
      var scaledown = 1;
      if (parseInt(imageObj.width) >= parseInt(imageObj.height)) {
        if (parseInt(imageObj.width) > (maximagewidth/imagescale)) {
          scaledown = (maximagewidth/imagescale)/parseInt(imageObj.width);
        }
      }
      else {
        if (parseInt(imageObj.height) > (maximageheight/imagescale)) {
          scaledown = (maximagewidth/imagescale)/parseInt(imageObj.height);
        }
      }
      $('#canvas_'+this_id).width(parseInt(imageObj.width)*scaledown*upscale);
      $('#canvas_'+this_id).height(parseInt(imageObj.height)*scaledown*upscale);
      $('#image_'+this_id).width(parseInt(imageObj.width)*scaledown*upscale);
      $('#image_'+this_id).height(parseInt(imageObj.height)*scaledown*upscale);
      canvas.width = imageObj.width*upscale;
      canvas.height = imageObj.height*upscale;
    }
      
      function scaleImageCanvas (val) {
        $("#images-logos div.logo").each(function(){
          $(this).css('width',parseInt($(this).css('width'))*val);
          $(this).css('height',parseInt($(this).css('height'))*val);
          $(this).find('canvas').css('width',parseInt($(this).find('canvas').css('width'))*val);
          $(this).find('canvas').css('height',parseInt($(this).find('canvas').css('height'))*val);
      if ($(this).width() < $(this).height()) {
          $(this).resizable ({aspectRatio: true, autohide: true, maxHeight: maximageheight/imagescale*upscale});
      }
      else {
          $(this).resizable ({aspectRatio: true, autohide: true, maxWidth: maximagewidth/imagescale*upscale});
      }
        });
      }
    
    function addImage (logo) {
        
      this_id = $("#images-logos div").length;
      $("#images-logos").append('<div id="image_' + this_id + '" class="logo"></div>');
      addImagetoCanvas (logo, this_id);

      $("#images-logos div").draggable();
      if ($('#image_'+this_id).width() >= $('#image_'+this_id).height()) {
          $('#image_'+this_id).resizable ({aspectRatio: true, autohide: true, maxHeight: maximageheight/imagescale*upscale});
      }
      else {
          $('#image_'+this_id).resizable ({aspectRatio: true, autohide: true, maxWidth: maximagewidth/imagescale*upscale});
      }
      
            //$(this).find('canvas').width($(this).width()*upscale);
            //$(this).find('canvas').height($(this).height()*upscale);
      
      /* Dont remove the div as we need to be able to count to use for id */
      $("#images-logos canvas").dblclick (function() {
        $(this).remove();
      });
        $("#images-logos .logo").mouseover (function () {
          $(this).find('.ui-icon').css('display','inline');
        });
        $("#images-logos .logo").mouseout (function () {
          $(this).find('.ui-icon').css('display','none');
        });
      
      $("#images-logos div.logo").resize (function() {
          //$(this).css('width',parseInt($(this).css('width'))*val);
          //$(this).css('height',parseInt($(this).css('height'))*val);
          //$(this).find('canvas').css('width',parseInt($(this).css('width')));
          //$(this).find('canvas').css('height',parseInt($(this).css('height')));
          
      var canvas = document.getElementById($(this).find('canvas').attr('id'));
      //canvas.setAttribute('width', parseInt($(this).css('width')));
      canvas.width = parseInt($(this).css('width'));
      canvas.height = parseInt($(this).css('height'));

      });
    }
    
    function changeFontsizeVariable (widget, val) {
       switch (widget) {
         case "text1": document.PrintLetters.fontsize_line1.value = val * fontratio; break;
         case "text2": document.PrintLetters.fontsize_line2.value = val * fontratio; break;
         case "text3": document.PrintLetters.fontsize_line3.value = val * fontratio; break;
         case "text4": document.PrintLetters.fontsize_line4.value = val * fontratio; break;
         case "text5": document.PrintLetters.fontsize_line5.value = val * fontratio; break;
         case "text6": document.PrintLetters.fontsize_line6.value = val * fontratio; break;
         case "text7": document.PrintLetters.fontsize_line7.value = val * fontratio; break;
         case "text8": document.PrintLetters.fontsize_line8.value = val * fontratio; break;
       }
     }
     
     function changeFontsizeGlobal (val) {
           document.PrintLetters.fontsize_line1.value = val * fontratio;
           document.PrintLetters.fontsize_line2.value = val * fontratio;
           document.PrintLetters.fontsize_line3.value = val * fontratio;
           document.PrintLetters.fontsize_line4.value = val * fontratio;
           document.PrintLetters.fontsize_line5.value = val * fontratio;
           document.PrintLetters.fontsize_line6.value = val * fontratio;
           document.PrintLetters.fontsize_line7.value = val * fontratio;
           document.PrintLetters.fontsize_line8.value = val * fontratio;    
     }
     
     function setSliderColour (widget, val) {
       if (val > maxfontsize*twopageupscale) {
         $("#"+$(widget).attr('id')+" .ui-slider-handle").css("background","red");
         $("#"+$(widget).attr('id')+" .ui-slider-handle").html("4");
       }
       else if (val > maxfontsize) {
         $("#"+$(widget).attr('id')+" .ui-slider-handle").css("background","green");
         $("#"+$(widget).attr('id')+" .ui-slider-handle").html("2");
       }
       else {
         $("#"+$(widget).attr('id')+" .ui-slider-handle").css("background","blue");
         $("#"+$(widget).attr('id')+" .ui-slider-handle").html("1");
       }
     }
     
     function addSlider (widget) {
     $( widget ).slider({
         range: "min",
         max: maxfontsize,
         min: minfontsize,
         step: fontstep,
         value: maxfontsize-1,
         change: function(event, ui) { 
           changeTextSize ($(this).attr('ref'));
           changeFontsizeVariable ($(this).attr('ref'), ui.value);
           setSliderColour ($(this), ui.value);
         },
         slide: function(event, ui) { 
           changeTextSize ($(this).attr('ref'));
           changeFontsizeVariable ($(this).attr('ref'), ui.value);
           /*
           var heightm = $('#'+$(this).attr('ref')).height()*ratio/1000;
           $("#"+$(this).attr('ref')+"-height-amount").val(heightm + " m");
           var widthm = $('#'+$(this).attr('ref')).width()*ratio/1000;
           $("#"+$(this).attr('ref')+"-width-amount").val(widthm + " m");
           */

           setSliderColour ($(this), ui.value);
         },
         create: function(event, ui) {
           $("#text"+$(this).attr('ref')).css("font-size", ui.value*upscale);
           setSliderColour ($(this), ui.value);

         }
         
     });
     }
     
         
      function addTextBox (textnum, txt) {
        $("#text").append("<div id='text"+textnum+"' class='display-text'><div class='gg'></div></div>");

        var textbox = "<tr id='textbox_"+textnum+"'>";
        if (txt != null) {
        	textbox += "<td><input class='textinput' type='text' name='text"+textnum+"_val' ref='text"+textnum+"' value='"+txt+"' /></td>";
		}
		else {
        	textbox += "<td><input class='textinput' type='text' name='text"+textnum+"_val' ref='text"+textnum+"' placeholder='Insert text here' /></td>";
		}

        textbox += "<td><input class='centered' type='checkbox' name='line"+textnum+"centered' value='text"+textnum+"' checked/></td>";
        textbox += "<td><input class='capitals' type='checkbox' name='text"+textnum+"' value='text"+textnum+"' checked/>";
        textbox += "<td><div id='line"+textnum+"-slider' class='fontsize' ref='text"+textnum+"'></div>";
        //textbox += "<label for='text"+textnum+"-width-amount'></label>";
	//textbox += "<input type='text' id='text"+textnum+"-width-amount' style='border:0; color:#f6931f; font-weight:bold;' />";
        //textbox += "<label for='text"+textnum+"-height-amount'> x </label>";
	//textbox += "<input type='text' id='text"+textnum+"-height-amount' style='border:0; color:#f6931f; font-weight:bold;' />";
	textbox += "</td>";
        textbox += "<td><div id='line"+textnum+"-rotator' class='rotator'></div></td>";
        textbox += "<td><div id='textcolour"+textnum+"' class='colourselector chosencolour' value='"+textnum+"'><div style='background-color:#fff;'></div></div></td>";
        textbox += "<td><div class='remove_row' value='"+textnum+"'>x</div></td>";
        textbox += "</tr>";
        $("#textvalues table").append(textbox);
        //$("#globals").append("<input type='hidden' name='text"+textnum+"_actual' />");

        //$("#text"+textnum).html($("#textbox_"+textnum+" input").attr('value')+'j');
        $('#text'+textnum).append("<div class='object_settings'></div>");
        $("#text"+textnum).draggable({
          axis: "y",
        });
        addSlider("#line"+textnum+"-slider");
       //positionText ($("#text"+textnum), $(".centered[value="+$('#text'+textnum).attr('id')+"]"), 0, 0); 
       centerText ($("#text"+textnum));

       lockFontSize();
       
       $("#text"+textnum).dblclick(function(){
         deleteTextBox (textnum);
       });
       
       /* Add outline box for hovering over text */
       $("#text"+textnum).css('border','1px solid transparent');
       $("#text"+textnum).mouseover(function(){
         $(this).css('border','1px solid red');
       });
       $("#text"+textnum).mouseout(function(){
         $(this).css('border','1px solid transparent');
         //$(this).find('.object_settings').remove();
       });
       $("#text"+textnum).on("click",function(){
       	 $(this).off("click");
         $(this).css('border','1px solid red');
         //$(this).append('<div class="object_settings"></div>');
         //$(this).find('.object_settings').append($("#textbox_"+textnum).html());
       });
       
       
       $( "#line"+textnum+"-rotator" ).slider({
         range: "min",
         max: 360,
         min: 0,
         step: 10,
         value: 0,
         slide: function(event, ui) { 
           var heightm = ui.value/4;
           $("#text"+textnum).css("-webkit-transform", "rotate("+ ui.value + "deg)");
         }
         
     });

     $(".remove_row").click( function() {
       deleteTextBox ($(this).attr('value'));

     });
     
      
      makeColourSelector($('#textcolour'+textnum));
      
      $('#gridcolor .sample-colours div').click(function(){
      });
      
      $(".sample-colours div").click(function(){
        $(this).parent().parent().parent().parent().css('background-color', $(this).css('background-color'));
	$("#text"+$(this).parent().parent().parent().parent().attr('value')).css('color', $(this).css('background-color'));
        //$(this).parent().parent().fadeOut(50);
      });

      }  
      
      function deleteTextBox (widget) {
        $("#text"+widget).html("");
        $("#textbox_"+widget).remove();
      }
        
     function centerTextBoxes () {
       $('input:checkbox[class="centered"]').each(function(){
         if ($(this).is(':checked')) {
           centerText($('#'+$(this).val()));
         }
       
       });
     }
     
     function makeColourSelector (widget) {
        var colourcode = "<div class='sample-colours radius'><ul>";
        for (col=0; col<pallet.length;col++) {
          colourcode += "<li><div style='background-color:"+pallet[col]+"'></div></li>";
        }
        colourcode += "</ul></div>";
        $(widget).append(colourcode);
        
      $(".colourselector").live("click",function(){
        $(this).children(".sample-colours").fadeIn(100);
      });
      $(".colourselector").live("mouseleave",function() {
        $(this).children(".sample-colours").fadeOut(50);
      });

      }
     
     function positionText(textwidget, checkbox, leftdiff, topdiff) {
       if (checkbox != null) {
         if ($(checkbox).is(':checked')) {
           centerText($(textwidget));
           alert('checked');
         }
         else {
         alert('not');
           var currenttextleft = parseInt($(textwidget).css('left'));
           var direction = 1;
           if (currenttextleft > $("#container").width()/2) {
             direction = -1;
           }
           var newtextleft = currenttextleft + (direction * (currenttextleft * leftdiff));
           $(textwidget).css('left', newtextleft);
         }
       }
       $(textwidget).css('top', parseInt($(textwidget).css('top')) + (parseInt($(textwidget).css('top'))*topdiff));
     }
     
     $(".display-text").click(function(){
     	alert('hjer');
     	$(this).css("border","1px solid red");
     });
     
     function setBackgroundWidth (newwidth) {
       var widthm = newwidth;
       var containerwidth = $("#container").width();
       var currentbackgroundleft = parseInt($("#background").css('left'));
       var newbackgroundleft = Math.round((containerwidth - newwidth)/2);
       var leftdiff =  (newbackgroundleft-currentbackgroundleft)/containerwidth;
       $("#width-amount").val(Math.round(widthm*1000) + " mm");
       $("#background, .banner-size, #gridlines").width(widthm);
       $("#background, #gridlines").css('left', 0);
       setBackground('background', $("#background-fillsettings li.selected canvas").attr("value"));
       
       $(".text-display").each(function() {
         switch ($(this).attr('id')) {
           case ('text1'):
             positionText ($(this), $('input:checkbox[value="line1centered"]'), leftdiff, 0); 
           break;
           case ('text2'):
             positionText ($(this),$('input:checkbox[name="line2centered"]'), leftdiff, 0); 
           break;
           case ('text3'):
             positionText ($(this),$('input:checkbox[name="line3centered"]'), leftdiff, 0); 
           break;
           case ('text4'):
             positionText ($(this),$('input:checkbox[name="line4centered"]'),  leftdiff, 0); 
           break;
         }              
       });
     }
     
     function setBackgroundHeight (val) {
       var heightm = val;
       var currentbackgroundheight = $("#background").height();
       topdiff = (val-currentbackgroundheight)/$("#container").height();
       $("#height-amount").val(Math.round(heightm*1000) + " mm");
       $("#background, .banner-size, #gridlines").height(heightm);
       $(".text-display").each(function() {
         positionText ($(this), null, 0, topdiff); 
       });
       setBackground('background', $("#background-fillsettings li.selected canvas").attr("value"));

       
     }
      function adjustTextSizeSlider (slider, maxvalue) {
        curr_val = $(slider).slider("value");
        $(slider).slider("option", "max", maxvalue);
        if (curr_val > maxvalue) { 
          $(slider).slider("option", "value", maxvalue);
        }
        else {
          $(slider).slider("option", "value", curr_val);
        }
     
      }

      function adjustTextSizeSliders (maxvalue) {
        $(".fontsize").each( function() {
          adjustTextSizeSlider("#"+$(this).attr('id'),maxvalue);
        });
      }
      function initialiseSettings() {
        changeAllBackgrounds();

        setBackground('background', $("#background-fillsettings li.selected canvas").attr("value"));
      
        $("#line1-slider").slider("value",20);
        $("#line2-slider").slider("value",20);
        $("#line3-slider").slider("value",20);
        $("#line4-slider").slider("value",20);
        $("#global-fontsize-slider").slider("value",maxfontsize);
      
        $('#global-fontsize').attr('checked', true);
        lockFontSize();
        setBannerSize ($("input[name=bannersize]:checked").val());
      
      /*
        addTextBox (1,"Congratulations");
        addTextBox (2, "Aiden");
        addTextBox (3, "50 Games");
        */
        addTextBox (1, "Well Done");
        addTextBox (2, "Aiden");
        addTextBox (3, "50 Games");
        makeUppercase();
        
        buildGrids(10*(10*upscale), 100*(10*upscale),'gridlines');
        

        //addJumper();     
      }
      function makeCentered () { 
        if ($('#global-centered').is(':checked')) {
          $('.centered').each(function() {
            $(this).attr('checked', $('#global-centered').is(':checked'));
          });
        }
        
        $('#text div').each (function() {
          if ($('#global-centered').is(':checked')) {
            centerText($("#"+$(this).attr('id')));
          }
          else {
            if ($(".centered[value="+$(this).attr('id')+"]").is(':checked')) {
             centerText($("#"+$(this).attr('id')));
            }  
          }        
        });
      }
     
     function changeTextCase(widgetname) {
       widget = "#"+widgetname;
          if ($(".capitals[name="+widgetname+"]").is(':checked')) {
            $(".textinput[name="+widgetname+"_val]").addClass("upper");
            changeText ($(".textinput[name="+widgetname+"_val]").val(), widgetname);
            }
          else {
            $(".textinput[name="+widgetname+"_val]").removeClass("upper");
            changeText ($(".textinput[name="+widgetname+"_val]").val(), widgetname);
          }
     }
     
      function makeUppercase() {
        if ($('#global-capitals').is(':checked')) {
          $('.capitals').each(function() {
            $(this).attr('checked', $('#global-capitals').is(':checked'));
          });
        
          $(".textinput").each(function() {
            changeTextCase($(this).attr('ref'));
          });
        }
      }
      
     function centerText (widget) {
         $(widget).css('left', (parseInt($("#background").css('left')) + $("#background").width()/2) - $(widget).width()/2);
     }

    function setFontSizeSetting (widgetname, val) {
          var widget = "#" + widgetname;

          switch (widgetname) {
            case "text1":
              document.PrintLetters.text1_actual.value = val;
            break;
            case "text2":
              document.PrintLetters.text2_actual.value = val;
            break;
            case "text3":
              document.PrintLetters.text3_actual.value = val;
            break;
            case "text4":
              document.PrintLetters.text4_actual.value = val;
            break;
            case "text5":
              document.PrintLetters.text5_actual.value = val;
            break;
            case "text6":
              document.PrintLetters.text6_actual.value = val;
            break;
            case "text7":
              document.PrintLetters.text7_actual.value = val;
            break;
            case "text8":
              document.PrintLetters.text8_actual.value = val;
            break;
          }
    
    }
        function changeText (val, widgetname) {
          if ($(".capitals[name=" + widgetname + "]").is(":checked")) {
            val = val.toUpperCase();
          }
          var widget = "#" + widgetname;
          
          $(widget).text(val);
          
          switch (widgetname) {

            case "text1":
              document.PrintLetters.text1_actual.value = val;
            break;
            case "text2":
              document.PrintLetters.text2_actual.value = val;
            break;
            case "text3":
              document.PrintLetters.text3_actual.value = val;
            break;
            case "text4":
              document.PrintLetters.text4_actual.value = val;
            break;
            case "text5":
              document.PrintLetters.text5_actual.value = val;
            break;
            case "text6":
              document.PrintLetters.text6_actual.value = val;
            break;
            case "text7":
              document.PrintLetters.text7_actual.value = val;
            break;
            case "text8":
              document.PrintLetters.text8_actual.value = val;
            break;
          }

          centerText (widget);
        }
        
      function changeTextSize (widget) {
        if ($("#global-fontsize").is(':checked')) {
          $("#"+widget).css('font-size', $("#global-fontsize-slider").slider("value")*upscale);
          changeFontsizeGlobal ($("#global-fontsize-slider").slider('value'));
        }
        else {
          $("#"+widget).css('font-size', $(".fontsize[ref="+widget+"]").slider("value")*upscale);
          changeFontsizeVariable (widget, $(".fontsize[ref="+widget+"]").slider("value"));
        }
        if ($(".centered[value="+$("#"+widget).attr('id')+"]").is(':checked')) {
          centerText($("#"+$("#"+widget).attr('id')));
        }          
      }
      
      function changeTextSizes() {
        $('#text div').each (function() {
          changeTextSize ($(this).attr('id'));
        
        });
      }
      
      function lockFontSize () {
          if ($("#global-fontsize").is(":checked")) {
            $(".fontsize").each(function() {
              $(this).slider("disable");
              $("#global-fontsize-slider").slider("enable");
            });
          
          }
          else {
            $(".fontsize").each(function() {
              $(this).slider("enable");
              $("#global-fontsize-slider").slider("disable");
             
            });
          }
          changeTextSizes();

          
      }       
      
      function performScale(currentscale) {
      /*
        if (upscale == 1) {
          $(".fontsize").slider("option","min", 10);
          if (currentscale != upscale) {
            scaleImageCanvas(upscale);
            $(".fontsize").each(function(){
              var currval = $(this).slider("value");
              $(this).slider("option","value", currval*upscale);
            });
          }
        }
        else {*/
          $(".fontsize").slider("option","min",1);
          if (currentscale != upscale) {
            scaleImageCanvas(upscale);
            $(".fontsize").each(function(){
              var currval = $(this).slider("value");
              $(this).slider("option","value", currval/upscale);
            });
          }
 /*       }*/
        
        changeTextSizes();   
        
      }
      
      function myRound (val) {
      	return (Number(val.toString().match(/^\d+(?:\.\d{0,2})?/)));
      }
      function getScale(width, height) {
      	
  		overscale = false;
  		var rawupscale;
   	
      	if (height <= maxScreenHeight && width <= maxScreenWidth) {
      		rawupscale = 1;
      	}
      	else if (height > maxScreenHeight && width <= maxScreenWidth) {
      			rawupscale = maxScreenHeight/height;
  		}
  		else if (height <= maxScreenHeight && width > maxScreenWidth) {
  			rawupscale = maxScreenWidth/width;
  		}
  			
  		else {
  			if ((height - maxScreenHeight) > (width - maxScreenWidth)){
  				rawupscale = maxScreenWidth/width;
  			}
  			else {
  				rawupscale = maxScreenHeight/height;
  			}
  			overscale = true;
  		}
  		upscale = myRound(rawupscale);
      	console.log ('width >> '+width+' height >> '+height+ ' upscale >> '+upscale+ ' overscale >>'+overscale);
      	
		return(upscale);  		
      }
      
      function setBackgroundSize(bgWidth, bgHeight) {
      	    var newScale;
      	    newScale = getScale(bgWidth, bgHeight);
	  	    setBackgroundWidth (bgWidth*newScale);
	        setBackgroundHeight (bgHeight*newScale);
      }
                  
      function setBannerSize (size) {
      	var newScale;
        var currentscale = upscale;
        smallbannerscale = 10;
        switch (size) {
          case "3x1.8":
            setBackgroundSize (3000,1800);
            $('#customsize').slideUp('fast', function() {});
          break;
          case "4x2.3":
          	setBackgroundSize (4000,2300);
            $('#customsize').slideUp('fast', function() {});
          break;
          case "6x2.8":
          	setBackgroundSize (6000,2800);
            $('#customsize').slideUp('fast', function() {});
          break;

          case "0.42x0.3":
          	setBackgroundSize (295,420);
            $('#customsize').slideUp('fast', function() {});
          break;
          case "0.3x0.42":
          	setBackgroundSize (420,295);
            $('#customsize').slideUp('fast', function() {});
          break;
          case "0.63x0.51":
          	setBackgroundSize (510,630);
            $('#customsize').slideUp('fast', function() {});
          break;
          case "0.51x0.63":
          	setBackgroundSize (630,510);
            $('#customsize').slideUp('fast', function() {});
          break;
          
           case "0.77x0.50":
          	setBackgroundSize (770,500);
            $('#customsize').slideUp('fast', function() {});
          break;
           case "0.50x0.77":
          	setBackgroundSize (500,770);
            $('#customsize').slideUp('fast', function() {});
          break;

         case "custom":
            $('#customsize').slideDown('fast', function() {});
            
            if (($( "#width-slider" ).slider("value") < 1000) || ($( "#height-slider" ).slider("value") < 1000)) {
            alert($( "#width-slider" ).slider("value"));
              upscale = getScale($( "#width-slider" ).slider("value"),$( "#height-slider" ).slider("value"));
            }
            else {
              upscale = getScale($( "#width-slider" ).slider("value"),$( "#height-slider" ).slider("value"));
            }
            setBackgroundWidth($( "#width-slider" ).slider("value")*upscale);
            setBackgroundHeight($( "#height-slider" ).slider("value")*upscale);
          break;
        }
        
        performScale (upscale);
        
        if (overscale == true) {
        	buildGrids(10*(10*upscale), 100*(10*upscale),'gridlines');

        }
        else  {
        	buildGrids(upscale*100, 100,'gridlines');
        }
      }
      
      
function draw(scale, translatePos){
    var canvas = document.getElementById("background");
    var context = canvas.getContext("2d");
 
    // clear canvas
    //context.clearRect(0, 0, canvas.width, canvas.height);
 
    context.save();
    context.translate(translatePos.x, translatePos.y);
    context.scale(scale, scale);
    /*
    context.beginPath(); // begin custom shape
    context.moveTo(-119, -20);
    context.bezierCurveTo(-159, 0, -159, 50, -59, 50);
    context.bezierCurveTo(-39, 80, 31, 80, 51, 50);
    context.bezierCurveTo(131, 50, 131, 20, 101, 0);
    context.bezierCurveTo(141, -60, 81, -70, 51, -50);
    context.bezierCurveTo(31, -95, -39, -80, -39, -50);
    context.bezierCurveTo(-89, -95, -139, -80, -119, -20);
    context.closePath(); // complete custom shape
    var grd = context.createLinearGradient(-59, -100, 81, 100);
    grd.addColorStop(0, "#8ED6FF"); // light blue
    grd.addColorStop(1, "#004CB3"); // dark blue
    context.fillStyle = grd;
    context.fill();
 
    context.lineWidth = 5;
    context.strokeStyle = "#0000ff";
    context.stroke();
    */
    context.restore();
    
}

function buildGrids(gridPixelSize, gap, div)
{
	
	//blah
var color = $('#gridcolor > div').css('background-color');
color = '#eee';

clearCanvas(div);

var canvas = $('#'+div+'').get(0);
var ctx = canvas.getContext("2d");

var bkgcanvas = $('#background').get(0);
var bkgcanvas = canvas.getContext("2d");

canvas.width = $('#background').width();
canvas.height = $('#background').height();
//canvas.height = bkgcanvas.height;
 
ctx.lineWidth = 0.5;
ctx.strokeStyle = color;
 
 
// horizontal grid lines
for(var i = 0; i <= canvas.height; i = i + gridPixelSize)
{
	ctx.beginPath();
	ctx.moveTo(0, i);
	ctx.lineTo(canvas.width, i);
	if(i % parseInt(gap) == 0) {
	ctx.lineWidth = 2;
	} else {
	ctx.lineWidth = 0.5;
	}
	ctx.closePath();
	ctx.stroke();
	}
	 
	// vertical grid lines
	for(var j = 0; j <= canvas.width; j = j + gridPixelSize)
	{
	ctx.beginPath();
	ctx.moveTo(j, 0);
	ctx.lineTo(j, canvas.height);
	if(j % parseInt(gap) == 0) {
	ctx.lineWidth = 2;
	} else {
	ctx.lineWidth = 0.5;
	}
	ctx.closePath();
	ctx.stroke();
	}
 
}
      