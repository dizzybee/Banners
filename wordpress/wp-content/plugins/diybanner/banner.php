<?php   
    /* 
    Plugin Name: DIY Banners 
    Plugin URI: http://www.dizzybee.com.au
    Description: Plugin for creating your own DIY Banners and large posters 
    Author: R. Bastholm
    Version: 1.0 
    Author URI: http://www.dizzybee.com.au 
    */  
    
    
    
add_shortcode("diy_banner", "testDIYBANNER");

function add_my_css_and_my_js_files(){
        wp_deregister_script( 'jquery' );
       //wp_deregister_script( 'jquery-ui-core' );
	   wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
        wp_enqueue_style( 'jqueryui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');
	    //wp_register_script( 'jquery-ui-core', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js');
		wp_enqueue_script('jquery');
		//wp_enqueue_script('jquery-ui-core');
	    wp_register_script( 'foundationsmodernizer', plugins_url('diybanner').'/foundations/js/vendor/modernizr.js');
		wp_enqueue_script('foundationsmodernizer');
        wp_enqueue_style( 'foundationsstyle', plugins_url('diybanner').'/foundations/css/foundation.css');
	    wp_register_script( 'foundationsjs', plugins_url('diybanner').'/foundations/js/foundation.min.js');
		wp_enqueue_script('foundationsjs');
	    wp_register_script( 'bannerjs', plugins_url('diybanner').'/banner.js');
		wp_enqueue_script('bannerjs');
        wp_enqueue_style( 'bannercss', plugins_url('diybanner').'/banner.css');
}

add_action('wp_enqueue_scripts', "add_my_css_and_my_js_files");
	
function testDIYBANNER() {
$_SESSION['paperSizes'] = array( 0 => array( "Measure"=>'Metric', "Value"=>'11', "Type"=>'poster','Width'=>1000,'Height'=>2000,'Description'=>'this is the description'));

?>
<!--<script type="text/javascript" src="banner-custom/js/colorpicker.js"></script>-->

<script>
var testarr = [{key: 'key1', value: 'value1'}, {key: 'key2', value: 'value2'}];
var paperSizes = [
	{'Name': '3m (w) x 1.8 (h)', "Measure":'Metric', "Value":'3x1.8', "Type":'runthrough','Width':3000,'Height':1800,'Description':'Great choice for 1-2 people'},
	{'Name': '4m (w) x 1.3 (h)', "Measure":'Metric', "Value":'4x2.3', "Type":'runthrough','Width':4000,'Height':2300,'Description':'Great choice for 1-2 people'},
	{'Name': '6m (w) x 2.8 (h)', "Measure":'Metric', "Value":'6x2.8', "Type":'runthrough','Width':6000,'Height':2800,'Description':'Great choice for more than 2 people or a small team'},
	{'Name': 'A3 Portrait', "Measure":'Metric', "Value":'0.42x0.3', "Type":'handheld','Width':420,'Height':300,'Description':''},
	{'Name': 'A3 Landscape', "Measure":'Metric', "Value":'0.3x0.42', "Type":'handheld','Width':300,'Height':420,'Description':''},
	{'Name': '510mm (w) x 630mm (h)', "Measure":'Metric', "Value":'0.51x0.63', "Type":'handheld','Width':510,'Height':630,'Description':''},
	{'Name': '630mm (w) x 510mm (h)', "Measure":'Metric', "Value":'0.63x0.51', "Type":'handheld','Width':630,'Height':510,'Description':''},
];
	function createPaperSelections() {
		var paper = '';
		paper += '<h4>Run-through Banners</h4><div class="thirds">';
		for (var runthrough=0;runthrough<paperSizes.length;runthrough++) {							
									
			if (paperSizes[runthrough]["Description"] !='') {
				paper += '<span data-tooltip class="has-tip" title="'+paperSizes[runthrough]["Description"]+'">';
			}
			paper += '<input type="radio" class="'+paperSizes[runthrough]["Type"]+'" name="bannersize" value="'+paperSizes[runthrough]['Value']+'" >';
			paper +=  paperSizes[runthrough]['Name'];
			if (paperSizes[runthrough]["Description"] !='') {
				paper += '</span>';
			}
			paper += '<br/>';
		}
		paper += '</div>';
		
		$('#backgroundsettings').prepend(paper);
		$("input[name=bannersize]").change(function() {
			setBannerSize($("input[name=bannersize]:checked").val());
			$(this).parentsUntil('#BannerSize').parent().find('.value').text($("input[name=bannersize]:checked").val());
		});
		$('input[name=bannersize]').first().attr('checked', true);
		$("input[name=bannersize]").parentsUntil('#BannerSize').parent().find('.value').text($("input[name=bannersize]:checked").val());
	}

	window.onload = function() {
	var canvas = document.getElementById("background");

	var translatePos = {
	x : canvas.width / 2,
	y : canvas.height / 2
	};

	var scale = 1.0;
	var scaleMultiplier = 0.9;
	var startDragOffset = {};
	var mouseDown = false;
	

	// add button event listeners
	document.getElementById("plus").addEventListener("click", function() {
	//setBackgroundWidth (canvas.width/scaleMultiplier);
	//setBackgroundHeight (canvas.height/scaleMultiplier);
	setBackground('background', '2v', scale, translatePos);
	}, false);

	document.getElementById("minus").addEventListener("click", function() {
	//setBackgroundWidth (canvas.width*scaleMultiplier);
	//setBackgroundHeight (canvas.height*scaleMultiplier);
	setBackground('background', '2v', scale, translatePos);
	}, false);
	// add event listeners to handle screen drag
	canvas.addEventListener("mousedown", function(evt) {
	mouseDown = true;
	startDragOffset.x = evt.clientX - translatePos.x;
	startDragOffset.y = evt.clientY - translatePos.y;
	});

	canvas.addEventListener("mouseup", function(evt) {
	mouseDown = false;
	});

	canvas.addEventListener("mouseover", function(evt) {
	mouseDown = false;
	});

	canvas.addEventListener("mouseout", function(evt) {
	mouseDown = false;
	});

	canvas.addEventListener("mousemove", function(evt) {
	if (mouseDown) {
	translatePos.x = evt.clientX - startDragOffset.x;
	translatePos.y = evt.clientY - startDragOffset.y;
	draw(scale, translatePos);
	}
	});

	draw(scale, translatePos);
	};
	/**************************************
	Window Load
	**************************************/
	$(window).load(function() {
	createPaperSelections();
	initialiseSettings();
	
	function handleFileSelect(evt) {
	var files = evt.target.files;
	// FileList object

	// Loop through the FileList and render image files as thumbnails.
	for (var i = 0, f; f = files[i]; i++) {

	// Only process image files.
	if (!f.type.match('image.*')) {
	continue;
	}

	var reader = new FileReader();

	// Closure to capture the file information.
	reader.onload = (function(theFile) {
	return function(e) {
	// Render thumbnail.
	var span = document.createElement('li');
	span.classList.add("logo");
	span.innerHTML = ['<img src="', e.target.result, '" alt="', escape(theFile.name), '"/>'].join('');
	document.getElementById('custom-images-logos').insertBefore(span, null);
	span.childNodes[0].addEventListener('dblclick', function() {
	var imgname = $(this).attr('src');
	addImage(imgname);
	});
	};
	})(f);

	// Read in the image file as a data URL.
	reader.readAsDataURL(f);
	}
	}

	document.getElementById('files').addEventListener('change', handleFileSelect, false);
	});

	/**************************************
	Document ready
	**************************************/

	$(document).ready(function() {

	$("#jtabContainer").mouseleave(function() {
	$("#tabscontent .tabpage").css("display", "none");
	});

	$(".tabs li").hover(function() {

	});

	$('#accordion h2').click(function() {
	$(this).next().slideToggle();
	}).next().hide();

	/*
	$('#accordion h2').click(function(){
	$("#accordion").siblings("h2").next().slideUp(); // closes siblings
	$(this).slideDown("slow");
	});
	*/

	$('input:checkbox[class="centered"]').live("click", function() {
	var textboxname = $(this).val();
	if ($(this).is(':checked')) {
	centerText($("#" + textboxname));
	$("#" + textboxname).draggable('option', 'axis', 'y');
	} else {
	$("#" + textboxname).draggable('option', 'axis', 'false');
	}

	});

	$("#background-fillsettings li canvas").click(function() {
	$("#background-fillsettings li").removeClass("selected");
	$(this).parent().addClass("selected");
	setBackground('background', $(this).attr('value'));
	//setBackground('jumper-outline', $("input[name=background]:checked").val());
	});

	$("jjinput[name=bannersize]").change(function() {
		setBannerSize($("input[name=bannersize]:checked").val());
		$(this).parent().parent().parent().parent().find('.value').text($("input[name=bannersize]:checked").val());
	});

	$("#jumpers").draggable();

	$(".textinput").live("keyup", function() {
		changeText($(this).val(), $(this).attr('ref'));
	});
	$(".textinput").live("change", function() {
	changeText($(this).val(), $(this).attr('ref'));
	});

	$("#jumper1-number").focusout(function() {
	addNumber();
	});

	$("#images-logos-settings img, #custom-images-logos img").dblclick(function() {
	var imgname = $(this).attr('src');
	addImage(imgname);
	});

	$("#textmaxsize li").click(function() {
	document.PrintLetters.numpagesperletter.value = $("#textmaxsize li.selected").attr("value");

	$("#textmaxsize li").removeClass("selected");
	$(this).addClass("selected");
	switch ($("#textmaxsize li.selected img").attr("value")) {
		case "onepage":
		adjustTextSizeSliders(maxfontsize);
		txtval = '1';
		break;
		case "twopage":
		adjustTextSizeSliders(maxfontsize * 1.5);
		txtval = '2';
		break;
		case "fourpage":
		adjustTextSizeSliders(maxfontsize * 2);
		txtval = '4';
		break;
		}
	$('#selectedpapersize').html($("#textmaxsize li.selected img").attr("value"));
	$(this).parent().parent().parent().find('.value').text(txtval);

	});

	$("#width-slider").slider({
	range : "min",
	max : (6000 / ratio), // 6m
	min : (200 / ratio),
	step : 10,
	value : (1800 / ratio),
	slide : function(event, ui) {
	setBackgroundWidth(ui.value);
	},
	change : function(event, ui) {
	var currentscale = upscale;
	setBackgroundWidth(ui.value);
	if (ui.value < 1000 / ratio) {
	alert("need to upscale");
	upscale = 4;
	} else {
	upscale = 1;
	}

	performScale(100);
	}
	});

	$("#height-slider").slider({
	range : "min",
	max : (3000 / ratio), // 3 meters
	min : (200 / ratio),
	value : (1800 / ratio),
	step : 10,
	slide : function(event, ui) {
	setBackgroundHeight(ui.value);
	},
	change : function(event, ui) {
	var currentscale = upscale;
	setBackgroundHeight(ui.value);
	if (ui.value < 1000 / ratio) {
	alert("need to upscale");
	upscale = 4;
	} else {
	upscale = 1;
	}
	performScale(100);
	}
	});

	$(".fontsize").each(function() {
	addSlider($(this));
	});

	$("#global-fontsize-slider").slider({
	range : "min",
	max : maxfontsize,
	min : 10,
	step : 1,
	value : maxfontsize / 2,
	change : function(event, ui) {
	changeTextSizes();
	changeFontsizeGlobal(ui.value);
	setSliderColour($(this), ui.value);
	},
	slide : function(event, ui) {
	changeTextSizes();
	changeFontsizeGlobal(ui.value);
	setSliderColour($(this), ui.value);
	}
	});

	$('.edit').html('<img src="http://malus.local/banners/wordpress/wp-content/uploads/2014/02/pencil.png"/>');
	$('.print').html('<img src="http://malus.local/banners/wordpress/wp-content/uploads/2014/02/print.png"/>');
	
	$("#theme-selectorsettings li").click(function() {
	switch ($(this).attr("val")) {
	case "party":
	$(".theme-image").css("background-image", "url(images/party.jpg)");
	$(".theme-image").css("background-size", "100%");
	$(".theme-image").css("background-position", "top");

	break;
	case "afl":
	$(".theme-image").css("background-image", "url(images/stadium.jpg)");
	$(".theme-image").css("background-size", "120%");
	$(".theme-image").css("background-position", "bottom");

	break;
	case "classroom":
	$(".theme-image").css("background-image", "url(images/classroom.jpg)");
	$(".theme-image").css("background-size", "100%");
	$(".theme-image").css("background-position", "top");
	break;
	}
	});

	$('.capitals').live("change", function() {
	$('#global-capitals').attr('checked', false);
	var widget = $(this).attr('value');
	changeTextCase(widget);
	});

	$('.centered').live("change", function() {
	$('#global-centered').attr('checked', false);
	});

	$("#button-addtext").click(function() {
	var totalnum = $("#textvalues").children("div").length;
	if (totalnum > 7) {
	alert('You have reached maximum number of text boxes.  Please delete some before adding another one');
	} else {
	var textnum = $("#text div").length + 1;
	addTextBox(textnum, null);
	}
	});

	$(".colourselector").each(function() {
	makeColourSelector($(this));
	});

	$(".sample-colours div").click(function() {
	$(this).parent().parent().parent().parent().children('.chosencolour').css('background-color', $(this).css('background-color'));
	changeAllBackgrounds();
	});

	$(".info").prepend("<img class='infoimg' src='<?php echo plugins_url('diybanner'); ?>/images/info_blue.png'/>");
		$(".info img").mouseover(function() {
		var pos = $(this).position();
		$(this).parent('.info').children('span').css('top', pos.top);
		$(this).parent('.info').children('span').fadeIn(100);
		$(this).mouseout(function() {
		$(this).parent('.info').children('span').fadeOut(100);
		});
		});

		$("#gridson").change(function(){
		if (!$(this).is(':checked')) {
		$("#gridlines").addClass('hide');
		}
		else {
		$("#gridlines").removeClass('hide');
		}
		});

		//});
		
	$('.generalOptions').mouseleave(function(){
		$(this).find('.options').css('display','none');
	});
	$('.edit').on ("click mouseover", function(){
		$(this).parent().next('.options').css('display','inline');
		$(this).parent().next('.options').click(function() {
			//$(this).css('display','none');
		});
	});
	

});
		
		/* End document ready */
</script>

<div id="Banner" class="jPageSection">
	<div id="inner" class="jbanner-size tabsBottom">
		<canvas id="background" class="jbanner-size"></canvas>
		<canvas id="gridlines" class="jbanner-size"></canvas>
		<canvas id="testsize" style="float:left;position:relative"></canvas>
		<div id="jumpers"></div>

		<div id="text"></div>
		<div id="images-logos"></div>
	</div>
	<!--
	<div id="minus">
	smaller
	</div>
	<div id="plus">
	bigger
	</div>
	-->
<form name="PrintLetters" method="POST" action="<?php echo plugins_url('diybanner'); ?>/one-letter.php" target="_blank" onsubmit="printCanvas('images-logos');submit();">

	<div id="generalsettings">

                <table class="overallOptions">
                	<th>Guidelines</th><th>Page(s)/Letter</th><th>Banner Dimensions</th><th>Background Style and Colour</th><th>Print</th>
                	<tr  class="generalOptions">
                		<td>
					<input id="gridson" type="checkbox" name="gridson" value="Yes" checked>Show
        				<!--
        					<div id='gridcolor' class='colourselector chosencolour' value='"+textnum+"'><div style='background-color:#fff;'></div></div>
        				-->
					
                			
                		</td>
                		<td>
					<div id="PaperSize" class="generalOptions">
						<div class="current"><span class="value"></span><span class="edit">Edit</span></div>
						<div class="options">
							<h3>Number of pages per letter allowed:</h3>
							<div id="textmaxsize">
								<li class="selected"><img src="<?php echo plugins_url('diybanner'); ?>/images/one-page.gif"  value="onepage"/>
									<div class="info">
										<span>One A4 page (portrait) per letter</span>
									</div>
								</li>
								<li><img src="<?php echo plugins_url('diybanner'); ?>/images/two-pages.gif"  value="twopage"/>
									<div class="info">
		
										<span>Two A4 pages (landscape) per letter</span>
									</div>
								</li>
								<li><img src="<?php echo plugins_url('diybanner'); ?>/images/four-pages.gif"  value="fourpage" />
									<div class="info">
										<span>Four A4 pages (landscape) per letter </span>
									</div>
								</li>
								<input type="hidden" name="numpagesperletter" />
							</div>
						</div>
					</div>
<script>
	  	$('#textmaxsize > li').attr('selected');
        $('#PaperSize .value').text($("#textmaxsize li.selected").val());

</script>                			
                		</td>
                		<td>
			 		<div id="BannerSize" class="generalOptions">
						<div class="current"><span class="value"></span><span class="edit">Edit</span></div>
						<div class="options">
							<div id="backgroundsettings">
								<h3>Banner Sizing</h3>
									<h4>Custom Size</h4>
									<input type="radio" class="runthrough"  name="bannersize" value="custom">
									Custom Size
	
									<div id="customsize" style="display:none;">
										<label for="width-amount">Width:</label>
										<input type="text" id="width-amount" style="border:0; color:#f6931f; font-weight:bold;" />
	
										<div id="width-slider"></div>
										<br/>
										<label for="height-amount">Height:</label>
										<input type="text" id="height-amount" style="border:0; color:#f6931f; font-weight:bold;" />
										<div id="height-slider"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
                		</td>
                		<td>
					<div id="Background" class="generalOptions">
						<div class="current"><span class="value"></span><span class="edit">Edit</span></div>
						<div class="options">
					<div id="background-fillsettings">
						<div class="halves">
							<h3>Banner Background</h3>

							<li class="selected">
								<canvas id="2v-sample" class="sample"  value="2v"></canvas>
							</li>
							<li>
								<canvas id="2stripesh-sample" class="sample" value="2stripes-horizontal"></canvas>
							</li>
							<li>
								<canvas id="2stripesv-sample" class="sample" value="2stripes-vertical"></canvas>
							</li>
							<li>
								<canvas id="2bandsv-sample" class="sample" value="2bands-vertical"></canvas>
							</li>
							<li>
								<canvas id="2bandssidev-sample" class="sample" value="2bands-side-vertical"></canvas>
							</li>
							<li>
								<canvas id="2bandsh-sample" class="sample" value="2bands-horizontal"></canvas>
							</li>
							<li>
								<canvas id="2bandshthinmiddle-sample" class="sample" value="2bands-horizontal-thinmiddle"></canvas>
							</li>
							<li>
								<canvas id="solid-sample" class="sample" value="solid"></canvas>
							</li>
							<li>
								<canvas id="2tone-sample" class="sample" value="2tone"></canvas>
							</li>
							<li>
								<canvas id="2tonebackdiagonal-sample" class="sample" value="2tone-diagonalstripe-backwards"></canvas>
							</li>
							<li>
								<canvas id="2toneforwarddiagonal-sample" class="sample" value="2tone-diagonalstripe-forwards"></canvas>
							</li>
						</div>

						<div class="halves">

							<div id="colour-selectorsettings">
								<h3>Banner Colours</h3>
								<div id="customWidget">
									<div id="colour1" class="colourselector">
										<div class="chosencolour" style="background-color:#0000ff;"></div>
									</div>
									<div id="colour2" class="colourselector">
										<div class="chosencolour" style="background-color:#000000;"></div>
									</div>
								</div>
							</div>

							<div id="theme-selectorsettings">
								<h3>Banner Theme</h3>
								<li val="afl">
									AFL
								</li>
								<li val="party">
									Party
								</li>
								<li val="classroom">
									Classroom
								</li>

							</div>
						</div>
					</div>						</div>
					</div>
               			
                		</td>
                		<td>
					<div id="printSettings" class="generalOptions">
						<div class="current"><span class="value"></span><span class="edit print">Edit</span></div>
						<div class="options">
		                			<input id="printImages" type="checkbox" name="printImages" value="Yes" checked>Images
							<br/><input id="printLetters" type="checkbox" name="printLetters" value="Yes" checked>Letters
							<br/><input id="printConstruction" type="checkbox" name="printConstruction" value="Yes" checked>Construction Page
							<a href="#" data-reveal-id="myModal" data-reveal>view</a>
							<div id="myModal" class="reveal-modal" data-reveal>
					<div id="infoSheet">
						<canvas id="infoCanvas" class="banner-size"></canvas>
						<canvas id="infoDimensions" width="800px"></canvas>
						<div id="infoSteps"></div>
					</div>
							  <a class="close-reveal-modal">&#215;</a>
							</div>
							<br/><input type="submit" name="makepage" value="Print"/>
						</div>
					</div>
                		</td>
                	</tr>
                </table>
<div class-"settingsTabs">

			<dl class="tabs vertical" data-tab>
				<dd class="active">
					<a href="#TextTab">Text</a>
				</dd>
				<dd>
					<a href="#ImagesTab">Images</a>
				</dd>
				<dd>
					<a href="#InfoTab">Construction Guide</a>
				</dd>
				<div id="buttons">
				</div>
			</dl>
			<div class="tabs-content vertical">
				<div class="content active" id="TextTab">
					<div id="textsettings">
						<div id="textvalues">
							<table>
								<tr>
									<th style="min-width: 200px;"></th><th>Centered</th><th>Capitals</th><th>Text Size</th><th>Rotation</th><th>Text
									<br/>
									Colour</th><th>Remove</th>
								</tr>
								<tr id="global-text-settings">
									<td style="text-align:left;">Global Text Settings</td>
									<td>
									<input type="checkbox" id="global-centered" value="global" onClick="makeCentered();" checked />
									</td>
									<td>
									<input type="checkbox" id="global-capitals" value="capitals" onClick="makeUppercase();" checked />
									</td>
									<td width="100px">
									<input type="checkbox" id="global-fontsize" value="fontsize" onClick="lockFontSize();" checked />
									Lock <div id="global-fontsize-slider" class="fontsize"></div></td>
									<td width="100px"></td>
									<td></td>
									<td></td>
								</tr>
							</table>
							<input id="button-addtext" type="button" name="addtext" value="Add Text Box"/>
						</div>
					</div>
				</div>
				<div class="content" id="BackgroundTab">

				</div>
				<div class="content" id="ImagesTab">
					<div id="system-images">
						<h3>System Images:</h3>
						<div id="images-logos-settings">
							<ul>
								<?php
								//path to directory to open
								$directory = plugin_dir_path(__DIR__) . "diybanner/logos/";
								$url = plugins_url('diybanner/logos/');
								if (is_dir($directory)) {
									$dir_handle = @opendir($directory) or die("Unable to open folder");

									while (false !== ($file = readdir($dir_handle))) {
										if ($file != '.' && $file != '..' && $file != 'Thumbs.db') {
											echo "<li class='logo' title='Banner Logo'> <img src='" . $url . $file . "'alt='Banner-logo'/></li>";
										}
									}
									closedir($dir_handle);
								}
								?>
							</ul>
						</div>
					</div>
					<div id="custom-images">
						<h3>Custom Uploaded Images:</h3>
						<div id="custom-images-logos"></div>
						<input type="file" id="files" name="files[]" multiple />
					</div>
				</div>
				<div class="content" id="InfoTab">
				</div>

			</div> <!-- tabs content -->
			</div> <!--settingsTabs -->
			<div class="disused">
				<input id="jumper1-number" type="text" name="jumper1-number" value="3"/>

				<div id="globals">
					<input type="hidden" name="fontsize_line1" />
					<input type="hidden" name="fontsize_line2" />
					<input type="hidden" name="fontsize_line3" />
					<input type="hidden" name="fontsize_line4" />
					<input type="hidden" name="fontsize_line5" />
					<input type="hidden" name="fontsize_line6" />
					<input type="hidden" name="fontsize_line7" />
					<input type="hidden" name="fontsize_line8" />
					<input type="hidden" name="text1_actual" />
					<input type="hidden" name="text2_actual" />
					<input type="hidden" name="text3_actual" />
					<input type="hidden" name="text4_actual" />
					<input type="hidden" name="text5_actual" />
					<input type="hidden" name="text6_actual" />
					<input type="hidden" name="text7_actual" />
					<input type="hidden" name="text8_actual" />
					<input type="hidden" name="numpagesperletter" />
				</div>
			</div>
		<!--container-->
		<div id="colour-pallet"></div>

		<!-- END OF BANNER -->

		<!--<script src="js/vendor/jquery.js"></script>-->
		<script src="<?php echo plugins_url('diybanner'); ?>/foundations/js/foundation.min.js"></script>
			<script>
				$(document).foundation();
			</script>

	</div><!-- End Content row -->
		</form>
</div>
<?php
}
?>

