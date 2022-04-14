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
					<div class="card border-width-3 border-radius-0 border-color-hover-dark mb-4">
					<div class="card-body">

					<?php if(isset($details) && !empty($details))
					{
					?>				
									<h4 class="font-weight-bold text-uppercase text-4 mb-3">Commande n° <?php echo $details['order_id'];?></h4>
									<table class="shop_table cart-totals mb-0">
										<tbody>
											<tr>
												<td colspan="2" class="border-top-0">
													<strong class="text-color-dark">Vos articles commandés</strong>
												</td>
											
											</tr>
										
					<?php if(isset($itemsID) && !empty($itemsID))
					{
										
										foreach($itemsID as $ID)
										{
											$product = readGetValueTabByKey($ID['product_id'] , $productAll, 'product_id') ;
											$cat = readGetValueTabByKey($product['categorie_id'] , $listCat, 'categorie_id') ;

											// $product = $productModel->where('product_id', $ID['product_id'])->first();
											// $cat = $categoryModel->where('categorie_id', $product['categorie_id'])->first();
										?>
										<tr>
												<td>
													<strong class="d-block text-color-dark line-height-1 font-weight-semibold"><?php echo $product['product_name'];?> <span class="product-qty"></span></strong>
													<span class="text-1">Catégorie : <?php echo $cat['categorie_name'];?></span>
												</td>
												<td>
													<span class="text-1"> <?php echo $ID['quantity'];?></span>
												</td>
												<td class="text-right align-top">
													<span class="amount font-weight-medium text-color-grey"><?php echo $product['price'];?></span>
												</td>
											</tr>
										<?php
										} }
										?>
										
											
											<tr class="cart-subtotal">
												<td class="border-top-0">
													<strong class="text-color-dark">Subtotal</strong>
												</td>
												<td class="border-top-0 text-right">
													<strong><span class="amount font-weight-medium"><?php echo $details["total"]; ?> €</span></strong>
												</td>
											</tr>
											<tr class="shipping">
												<td class="border-top-0">
													<strong class="text-color-dark">Shipping</strong>
												</td>
												<td class="border-top-0 text-right">
													<strong><span class="amount font-weight-medium">Free Shipping</span></strong>
												</td>
											</tr>
											<tr class="total">
												<td>
													<strong class="text-color-dark text-3-5">Total</strong>
												</td>
												<td class="text-right">
													<strong class="text-color-dark"><span class="amount text-color-dark text-5"><?php echo $details["total"]; ?> €</span></strong>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<?php
						
					} else {
					?>
					<h3> Numéro de commande inconnu ou incorrecte </h3>
					<?php
					}
					?>
							</div>
							
							</div>
							
					</div>
				
				</div>

			</div>