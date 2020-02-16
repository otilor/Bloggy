<div class="home_slider_container">
			<div class="owl-carousel owl-theme home_slider">
				
				<!-- Slider Item -->
                <?php 
                    if(count($posts == 0)){
                        echo "No Posts!";
                    }
                ?>
				<?php foreach ($posts as $post): ?>
                
				<div class="owl-item">
					<div class="home_slider_background" style="background-image:url(images/home_slider.jpg)"></div>
					<div class="home_slider_content_container">
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="home_slider_content">
										<div class = "section_tags"><a href="category.php" class="trans_200"><?php echo htmlspecialchars($post["email"]); ?></a></div>
										<?php foreach(explode(",", $post["post_title"]) as $ind_post): ?>
										<div class="home_slider_item_title">

											<a href="post.php?id=<?php echo $post["post_id"];?>"><?php echo htmlspecialchars($ind_post);?></a>
										</div>
										<?php endforeach ?>
										<div class="home_slider_item_link">
											<a href = "post.php?id=<?php echo $post["post_id"]?>" class="trans_200">Continue Reading
												<svg version="1.1" id="link_arrow_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
													 width="19px" height="13px" viewBox="0 0 19 13" enable-background="new 0 0 19 13" xml:space="preserve">
													<polygon fill="#FFFFFF" points="12.475,0 11.061,0 17.081,6.021 0,6.021 0,7.021 17.038,7.021 11.06,13 12.474,13 18.974,6.5 "/>
												</svg>
											</a>
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach ?>