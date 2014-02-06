<?php
/**
 * Template Name: My Custom Front Page
 * Custom front-page.php template
 *
 * Used to display the homepage of your
 * WordPress site.
 *
 * @link http://themes.required.ch/?p=606
 */
 
get_header(); ?>
 
    <!-- Row for main content area -->
    <div id="content" class="row">
        <div id="main" class=" columns" role="main">
 
			<div id="Banner" class="PageSection">
				<div id="inner" class="jbanner-size tabsBottom">
					<canvas id="background" class="jbanner-size"></canvas>
					<canvas id="gridlines" class="jbanner-size"></canvas>
					<canvas id="testsize" style="float:left;position:relative"></canvas>
					<div id="jumpers"></div>

					<div id="text"></div>
					<div id="images-logos"></div>
				</div>
				<div id="minus">
					smaller
				</div>
				<div id="plus">
					bigger
				</div>

				<div id="generalsettings">

					<form name="PrintLetters" method="POST" action="http://www.dizzybee.com.au/banners/one-letter.php" target="_blank" onsubmit="printCanvas('images-logos');submit();">

						<dl class="tabs vertical" data-tab>
							<dd class="active">
								<a href="#TextTab">Text</a>
							</dd>
							<dd>
								<a href="#BannerSizeTab">Banner Size</a>
							</dd>
							<dd>
								<a href="#BackgroundTab">Background Size and Style</a>
							</dd>
							<dd>
								<a href="#ImagesTab">Images</a>
							</dd>
							<dd>
								<a href="#PaperSizeTab">Paper Size</a>
							</dd>
							<dd>
								<a href="#InfoTab">Construction Guide</a>
							</dd>
											<div id="buttons">
												<input type="submit" name="makepage" value="Print Letters"/>
											</div>
						</dl>
						<div class="tabs-content vertical">
							<div class="content active" id="TextTab">
								<div id="textsettings">
									<div id="textvalues">
										<table>
											<tr>
												<th></th><th>Centered</th><th>Capitals</th><th>Text Size</th><th>Rotation</th><th>Text
												<br/>
												Colour</th><th>Remove</th>
											</tr>
											<tr id="global-text-settings">
												<td>Global Text Settings</td>
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
							<div class="content" id="BannerSizeTab">
								<p>
									<div id="backgroundsettings">
										<h2>Banner Sizing</h2>
										<div class="thirds">
											<h3>Run-through Banners</h3>
											<input type="radio" class="runthrough" name="bannersize" value="3x1.8" checked>
											3m wide x 1.8m high
											<div class="info">
												<span>As a run-through banner, this size is  suitable for 1 or 2 junior Players</span>
											</div>
											<br/>
											<input type="radio" class="runthrough"  name="bannersize" value="4x2.3">
											4m wide x 2.3m high
											<div class="info">
												<span>As a run-through banner, this size is  suitable for 2 or more Players or for Senior Players</span>
											</div>
											<br/>
											<input type="radio" class="runthrough"  name="bannersize" value="6x2.8">
											6m wide x 2.8m high
											<br/>

											<h3>Big Wall Banners</h3>
											<input type="radio" class="wall" name="bannersize" value="3x1.8">
											3m wide x 1.8m high
											<br/>
											<input type="radio" class="wall"  name="bannersize" value="4x2.3">
											4m wide x 2.3m high
											<br/>
											<input type="radio" class="wall"  name="bannersize" value="6x2.8">
											6m wide x 2.8m high
										</div>

										<div class="thirds">

											<h3>Handheld Banners/School Project Posters</h3>
											<input type="radio" class="handheld" name="bannersize" value="0.42x0.3">
											A3 Portrait
											<br/>
											<input type="radio" class="handheld"  name="bannersize" value="0.3x0.42">
											A3 Landscape
											<br/>
											<input type="radio" class="handheld"  name="bannersize" value="0.63x0.51">
											510mm(w) x 630mm(h)
											<br/>
											<input type="radio" class="handheld"  name="bannersize" value="0.51x0.63">
											630mm(w) x 510mm(h)
											<br/>
											<input type="radio" class="handheld"  name="bannersize" value="0.63x0.51">
											510mm(w) x 630mm(h)
											<br/>
											<input type="radio" class="handheld"  name="bannersize" value="0.50x0.77">
											500mm(w) x 770mm(h)
											<br/>
											<input type="radio" class="handheld"  name="bannersize" value="0.77x0.50">
											770mm(w) x 500mm(h)
										</div>
										<div class="thirds">
											<h3>Custom Size</h3>
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
								</p>
							</div>
							<div class="content" id="BackgroundTab">
								<p>
									<div id="background-fillsettings">
										<div class="halves">
											<h2>Banner Background</h2>

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
												<h2>Banner Colours</h2>
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
												<h2>Banner Theme</h2>
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
									</div>
								</p>
							</div>
							<div class="content" id="ImagesTab">
								<div id="system-images">
									<h2>System Images:</h2>
									<div id="images-logos-settings">
										<ul>
											<?php
											//path to directory to open
											$directory = "banner-custom/logos/";
											if (is_dir($directory)) {
												$dir_handle = @opendir($directory) or die("Unable to open folder");
	
												while (false !== ($file = readdir($dir_handle))) {
													if ($file != '.' && $file != '..' && $file != 'Thumbs.db') {
														echo "<li class='logo' title='Banner Logo'> <img src='" . $directory . $file . "'alt='Banner-logo'/></li>";
													}
												}
												closedir($dir_handle);
											}
											?>
										</ul>
									</div>
								</div>
								<div id="custom-images">
									<h2>Custom Uploaded Images:</h2>
									<div id="custom-images-logos"></div>
									<input type="file" id="files" name="files[]" multiple />
								</div>
							</div>
							<div class="content" id="PaperSizeTab">
								<h2>Number of pages per letter allowed:</h2>
								<div id="textmaxsize">
									<li class="selected"><img src="./banner-custom/images/one-page.gif"  value="onepage"/>
										<div class="info">
											<span>One A4 page (portrait) per letter</span>
										</div>
									</li>
									<li><img src="./banner-custom/images/two-pages.gif"  value="twopage"/>
										<div class="info">
											
											<span>Two A4 pages (landscape) per letter</span>
										</div>
									</li>
									<li><img src="./banner-custom/images/four-pages.gif"  value="fourpage" />
										<div class="info">
											<span>Four A4 pages (landscape) per letter </span>
										</div>
									</li>
									<input type="hidden" name="numpagesperletter" />
								</div>
							</div>
							<div class="content" id="InfoTab">
								<div id="infoSheet">
									<canvas id="infoCanvas" class="banner-size"></canvas>
									<canvas id="infoDimensions" width="800px"></canvas>
									<div id="infoSteps"></div>
								</div>
							</div>

						</div>


				</div>
				<!--tabs content-->

			</div>
			<!-- End of #Banners -->

		</div><!--end of page-->
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
			</div>
		</div>

		</form>
		</div>
		</div>
		<!--container-->
		</div>

		<div id="colour-pallet"></div>

		<!-- END OF BANNER -->

		<!--<script src="js/vendor/jquery.js"></script>-->
		<script src="foundations/js/foundation.min.js"></script>
		<script>
			$(document).foundation();
		</script>

 
        </div><!-- /#main -->
 
    </div><!-- End Content row -->
 
<?php get_footer(); ?>