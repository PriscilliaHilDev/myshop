<div role="main" class="main shop pb-4">
				<div class="container">

					<div class="row justify-content-center">
						<div class="col-lg-8">
							<ul class="breadcrumb breadcrumb-dividers-no-opacity font-weight-bold text-6 justify-content-center my-5">
								<li class="text-transform-none mr-2">
									<a href="shop-cart.html" class="text-decoration-none text-color-dark text-color-hover-primary">Shopping Cart</a>
								</li>
								<li class="text-transform-none text-color-dark mr-2">
									<a href="shop-checkout.html" class="text-decoration-none text-color-dark text-color-hover-primary">Checkout</a>
								</li>
								<li class="text-transform-none text-color-dark">
									<a href="shop-order-complete.html" class="text-decoration-none text-color-primary">Order Complete</a>
								</li>
							</ul>
						</div>
					</div>

					<div class="row justify-content-center">
						<div class="col-lg-8">
							<div class="card border-width-3 border-radius-0 border-color-success">
								<div class="card-body text-center">
									<p class="text-color-dark font-weight-bold text-4-5 mb-0"><i class="fas fa-check text-color-success mr-1"></i> Thank You. Your Order has been received.</p>
								</div>
							</div>
						  </br>
							<div class="card border-width-3 border-radius-0 border-color-hover-dark mb-4">
								<div class="card-body">
								<h2>Récapitulatif de votre commande </h2>
									<h4 class="font-weight-bold text-uppercase text-4 mb-3">Commande n° :<?php echo $nbOrder; ?></h4>
									<table class="shop_table cart-totals mb-0">
										<tbody>
											<tr>
												<td colspan="2" class="border-top-0">
													<strong class="text-color-dark">Vos articles commandés</strong>
												</td>
											</tr>
											<?php
										
											if(isset($order) && !empty($order)){

												foreach($order as $list){
													
													// $product = $modelProduct->where('product_id', $list['product_id'])->first();
													$product = readGetValueTabByKey($list['product_id'] , $listProduct, "product_id" ) ;
													$cat = readGetValueTabByKey($product['categorie_id'] , $listCat, "categorie_id" ) ;
													 
													?>
														<tr>
														<td>
															<strong class="d-block text-color-dark line-height-1 font-weight-semibold"><?php echo $product['product_name'];?></strong>
															<span class="text-1">Catégorie : <?php echo $cat['categorie_name'];?></span>
														</td>
														<td>
															<span class="text-1"> Quantité : <?php echo $list['quantity'];?></span>
														</td>
														<td class="text-right align-top">
															<span class="amount font-weight-medium text-color-grey"><?php echo $product['price'];?> €</span>
														</td>
												
														</tr>
													<?php 
												}
												
											}
											?>
												<tr class="total">
												<td>
													<strong class="text-color-dark text-3-5">Total</strong>
												</td>
												<td class="text-right">
													<strong class="text-color-dark"><span class="amount text-color-dark text-5"><?php echo $totale; ?> €</span></strong>
												</td>
												</tr>
										</tbody>
									</table>
								</div>
							</div>
						
						</div>
					</div>

				</div>

			</div>


		