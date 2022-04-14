<div role="main" class="main shop pb-4">

				<div class="container">

					<div class="row justify-content-center">
						<div class="col-lg-8">
						<h4></h4>
							<ul class="breadcrumb breadcrumb-dividers-no-opacity font-weight-bold text-6 justify-content-center my-5">
								<li class="text-transform-none mr-2">
									<a href="shop-cart.html" class="text-decoration-none text-color-dark text-color-hover-primary">Mon compte</a>
								</li>
								<li class="text-transform-none text-color-dark mr-2">
									<a href="shop-checkout.html" class="text-decoration-none text-color-dark text-color-hover-primary">Mes commandes</a>
								</li>
								<li class="text-transform-none text-color-dark">
									<a href="shop-order-complete.html" class="text-decoration-none text-color-primary">Ma liste</a>
								</li>
							</ul>
						</div>
					</div>									

<?php // $user = $usersModel->where('user_id', $order['user_id'])->first(); ?>
<?php 

							if(isset($orders) && !empty($orders))
							{
								foreach($orders as $order)
								{
									// je boucle sur chaque order qui correspond a user connecté
									// Je chercher pour chaque orderid, dans panier (order_item) si il existe des produits pour afficher les commandes et leurs details
									$orderProduit = $panierModel->where('order_id', $order['order_id'])->first();
									if(!empty($orderProduit['product_id']))
									{
										
							?>
								<div class="d-flex flex-column flex-md-row justify-content-between py-3 px-4 my-4">
								<div class="text-center">
									<span>
										Numéro de commande <br>
										<a href='<?php echo base_url("orders/details/".$order['order_id'])?>'><strong class="text-color-dark"><?php echo $order['order_id']?></strong></a>
									</span>
								</div>
								<div class="text-center mt-4 mt-md-0">
									<span>
										Date <br>
										<strong class="text-color-dark"> <?php echo $order['date']?></strong>
									</span>
								</div>
								<div class="text-center mt-4 mt-md-0">
									<span>
										Email <br>
										<strong class="text-color-dark"><?php echo $user['email']?></strong>
									</span>
								</div>
								<div class="text-center mt-4 mt-md-0">
									<span>
										Total <br>
										<strong class="text-color-dark"> <?php echo $order['total']?>€</strong>
									</span>
								</div>
								<div class="text-center mt-4 mt-md-0">
									<span>
										Payment Method <br>
										<strong class="text-color-dark">Cash on Delivery</strong>
									</span>
								</div>
								<div class="text-center mt-4 mt-md-0">
									<span>
										Etat de la commande <br>
										<strong class="text-color-dark"><?php echo $order['etat']?></strong>
									</span>
								</div>
							</div>

							<?php
									}
									  }
								  } else {

								?>
								<h4> Aucunes commandes trouvées ... </h4>
								<?php
								  }
							?>
							
							
							
						
						</div>
					</div>

				</div>

			</div>