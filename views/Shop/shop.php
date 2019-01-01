<?php include_once('views/layout/headerShop.php') ?>
				<?php foreach ($data as $key => $value) {?>
				<div class="col-md-4 top_brand_left">
					<div class="hover14 column">
						<div class="agile_top_brand_left_grid">
							<!-- <div class="tag"><img src="images/tag.png" alt=" " class="img-responsive" /></div> -->
							<div class="agile_top_brand_left_grid1">
								<figure>
									<div class="snipcart-item block" >
										<div class="snipcart-thumb">
											<a href="single.html"><img title=" " alt=" " src="<?php if($value['img'] != null) echo $value['img']['0']['link']; else echo "public/image/product/defaul.png" ?>" /></a>		
											<p><?php echo $value['name'] ?></p>
											<h4><?php if( $value['product_detail'] != null) echo $value['product_detail'][0]['price']; else echo "Đang cập nhật" ?> <span>$10.00</span></h4>
										</div>
										<div class="snipcart-details top_brand_home_details">
											<form action="?mod=shop&act=detail&id=<?php echo  $value['id'] ?>" method="post">
												<fieldset>
													<!-- <input type="hidden" name="cmd" value="_cart" />
													<input type="hidden" name="add" value="1" />
													<input type="hidden" name="business" value=" " />
													<input type="hidden" name="item_name" value="Fortune Sunflower Oil" />
													<input type="hidden" name="amount" value="7.99" />
													<input type="hidden" name="discount_amount" value="1.00" />
													<input type="hidden" name="currency_code" value="USD" />
													<input type="hidden" name="return" value=" " />
													<input type="hidden" name="cancel_return" value=" " /> -->
													<input type="submit" name="submit" value="Xem Chi Tiết" class="button <?php if( $value['product_detail'] == null) echo "disabled" ?>" <?php if( $value['product_detail'] == null) echo "disabled" ?> style="" /> 
												</fieldset>
													
											</form>
									
										</div>
									</div>
								</figure>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
<?php include_once('views/layout/footerShop.php') ?>


				
				