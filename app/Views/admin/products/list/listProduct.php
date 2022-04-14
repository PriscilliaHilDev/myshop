

					<!-- start: page -->
				
					<div class="row justify-content-center justify-content-sm-between">
						<div class="col-sm-auto text-center mb-4 mb-sm-0 mt-2 mt-sm-0">
						<h2>Bienvenue</h2>
						<a  href="<?php echo base_url('admin/products/edition')?>" class="btn btn-dark btn-modern btn-block text-uppercase rounded-0 font-weight-bold text-3 py-3"> Ajouter un produit </a>
						</div>
						
					</div>
					<div class="row row-gutter-sm mb-6">
						
						<div class="col-lg col-xl">
							<div class="row row-gutter-sm">
							<!-- debut boucle-->
							<?php 
								if(isset($listProducts) && !empty($listProducts))
								{
									foreach($listProducts as $product)
									{

										$catProduct = readGetValueTabByKey($product['categorie_id'] , $category, "categorie_id" ) ;
										$sousCatProduct= readGetValueTabByKey($product['sous_categorie_id'] , $listSousCat, "sous_categorie_id" ) ;
										if(empty($catProduct))
										{
											$catProduct['categorie_name']  = 'divers';
										}
										if(empty($sousCatProduct))
										{
											$sousCatProduct['sous_categorie_name'] = "autres"; 
										}

										// $catProduct = $modelCat->where('categorie_id', $product["categorie_id"])->first();
										// $sousCatProduct = $modelSousCat->where('sous_categorie_id', $product["sous_categorie_id"])->first();
							?>
							
								<div class="col-sm-6 col-xl-4">
									<div class="card card-modern card-modern-alt-padding">
										<div class="card-body bg-light">
											<div class="image-frame mb-4">
											<?php if(isset($product["main_image"]) && !empty($product["main_image"])){ ?>
												<div class="image-frame-wrapper div-img">
													<a href="<?php echo base_url('admin/products/edition/'.$product['product_id'])?>"> <img src ="<?php echo '/uploads/'.$product["main_image"] ?>"  class="img-fluid taille-img" alt="Product Short Name" /></a>
												</div>
											<?php
											 }else {
											?>
											<div class="image-frame-wrapper div-img">
													<a href="<?php echo base_url('admin/products/edition/'.$product['product_id'])?>"><img src="images/default.png" class="img-fluid taille-img" alt="Product Short Name" /></a>
												</div>
											<?php
											 }
											 ?>
												
											</div>
											<small><a class="ecommerce-sidebar-link text-color-grey text-color-hover-primary text-decoration-none"><?php echo $sousCatProduct["sous_categorie_name"]; ?></a></small>
											<h4 class="text-4 line-height-2 mt-0 mb-2"><a  href="<?php echo base_url('admin/products/details/'.$product['product_id'])?>" class="ecommerce-sidebar-link text-color-dark text-color-hover-primary text-decoration-none"><strong> <?php echo  $product['product_name'];?></strong></a></h4>
											<h5 class="text-3 line-height-2 mt-0 mb-2"> Catégorie : <?php echo $catProduct['categorie_name'];?></h5>

											<div class="product-price">
												<div class="regular-price "><?php echo $product["price"]; ?> €</div>
								
											</div>
											<a class='mb-1 mt-1 mr-1 btn btn-info' href="<?php echo base_url('admin/products/edition/'.$product['product_id'])?>"><i class="bx bx-pencil"></i> </a>
											<a class='mb-1 mt-1 mr-1 btn btn-danger' href="<?php echo base_url('admin/products/delete/'.$product['product_id'])?>"><i class="bx bx-trash"></i></a>
										</div>
									</div>
								</div>
								<?php
									}
								}
							?>
							<!-- fin boucle-->
							</div>
							<div class="row row-gutter-sm justify-content-between">
								<div class="col-lg-auto order-2 order-lg-1">
								</div>
								<div class="col-lg-auto order-1 order-lg-2 mb-3 mb-lg-0">
									<nav aria-label="Page navigation example">
									  	<ul class="pagination pagination-modern pagination-modern-spacing justify-content-center justify-content-lg-start mb-0">
									    		
										  </li>
											<?php echo $pager->links() ?>
										      	
										    </li>
									  	</ul>
									</nav>
								</div>
							</div>
						</div>
					</div>
					<!-- end: page -->
				</section>
			</div>

			<aside id="sidebar-right" class="sidebar-right">
				<div class="nano">
					<div class="nano-content">
						<a href="#" class="mobile-close d-md-none">
							Collapse <i class="fas fa-chevron-right"></i>
						</a>
			
						<div class="sidebar-right-wrapper">
			
							<div class="sidebar-widget widget-calendar">
								<h6>Upcoming Tasks</h6>
								<div data-plugin-datepicker data-plugin-skin="dark"></div>
			
								<ul>
									<li>
										<time datetime="2017-04-19T00:00+00:00">04/19/2017</time>
										<span>Company Meeting</span>
									</li>
								</ul>
							</div>
			
							<div class="sidebar-widget widget-friends">
								<h6>Friends</h6>
								<ul>
									<li class="status-online">
										<figure class="profile-picture">
											<img src="img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-online">
										<figure class="profile-picture">
											<img src="img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-offline">
										<figure class="profile-picture">
											<img src="img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-offline">
										<figure class="profile-picture">
											<img src="img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
								</ul>
							</div>
			
						</div>
					</div>
				</div>
			</aside>

		</section>

		<!-- app-assets/vendor -->
