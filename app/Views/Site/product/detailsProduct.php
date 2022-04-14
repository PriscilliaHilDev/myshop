<div role="main" class="main shop pt-4">
				<div class="container">
				<div class="messagePanier"></div>
<?php if(isset($product) && !empty($product))
{
	$desactive = "";
	$titleButton ='';
	if(!session()->get('userID') && !$request->getCookie('idUser'))
	{
		$titleButton = "Veuillez vous connectez pour ajouter ce produit a votre panier";
		$desactive = 'disabled';
	}
	
?>
					<div class="row">
						<div class="col">
							<ul class="breadcrumb breadcrumb-style-2 d-block text-4 mb-4">
								<li><a href="#" class="text-color-default text-color-hover-primary text-decoration-none">Accueil</a></li>
								<li><a href="#" class="text-color-default text-color-hover-primary text-decoration-none"><?php echo $cat['categorie_name']?></a></li>
								<?php if(!empty($sousCategory)) { ?>
								<li><?php echo $sousCategory ?></li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5 mb-5 mb-md-0">						
							<div class="thumb-gallery-wrapper">
								<div class="thumb-gallery-detail">

									<?php if(isset($product["main_image"]) && !empty($product["main_image"])){ ?>
												<div class="image-frame-wrapper">
													<a href='#'> <img src ="<?php echo '/uploads/'.$product["main_image"] ?>"  class="img-fluid" alt="Product Short Name" /></a>
												</div>
											<?php
											 }else {
											?>
											<div class="image-frame-wrapper">
													<a href="<?php echo base_url('admin/products/details/'.$product['product_id'])?>"><img src="/images/default.png" class="img-fluid" alt="Product Short Name" /></a>
												</div>
											<?php
											 }
											 ?>									
									
								</div>
							</div> 

						</div>

						<div class="col-md-7">

							<div class="summary entry-summary position-relative">

								

								<h1 class="mb-0 font-weight-bold text-7"><?php echo $product['product_name'] ?></h1>

								<div class="pb-0 clearfix d-flex align-items-center">
									<div title="Rated 3 out of 5" class="float-left">
										<input type="text" class="d-none" value="3" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'primary', 'size':'xs'}">
									</div>
								</div>

								<div class="divider divider-small">
									<hr class="bg-color-grey-scale-4">
								</div>

								<p class="price mb-3">
									<span class="sale text-color-dark"><?php echo $product['price'];?> €</span>
								</p>
								<ul class="list list-unstyled text-2">
									<li class="mb-0">AVAILABILITY: <strong class="text-color-dark">
									<?php 
									        if(empty($product['available']))
											{
												$product['available'] = "rupture de stock";
												$desactive = 'disabled';
											} elseif($product['available'] == "rupture de stock")
											{
												$desactive = 'disabled';
											}
											
									echo $product['available'];?></strong></li>
									<li class="mb-0">Catégorie : <strong class="text-color-dark"> <?php 
									 if(empty($cat['categorie_name']))
									 {
										 $cat['categorie_name'] = "divers";
									 };
									echo $cat['categorie_name']; ?></strong></li>
								</ul>
							</div>
							<form  method="post" class="cart" >
											<div class="quantity quantity-lg">
												<input type="button" class="minus text-color-hover-light bg-color-hover-primary border-color-hover-primary" value="-">
												<input type="text" class="input-text qty text qt-produit" title="Qty" value="1" name="quantity" min="1" step="1">
												<input type="button" class="plus text-color-hover-light bg-color-hover-primary border-color-hover-primary" value="+">
											</div>
											<span class="d-inline-block " tabindex="0" data-toggle="tooltip" title="<?php echo $titleButton; ?>">
											<a id="addPanier" data-article = '<?php echo $product['product_name']; ?>'  data-ref="<?php echo $product['product_id'];?>"class="btn btn-dark btn-modern text-uppercase bg-color-hover-primary border-color-hover-primary <?php echo $desactive?>" > Ajouter au panier </a>
											</span>
											<hr>
							</form>
						</div>
						
					</div>
		

									<div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-sm">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title" id="smallModalLabel">Small Modal Title</h4>
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												</div>
												<div class="modal-body">
													<p class='name_article'> </p>
												</div>
												<div class="modal-body">
													<a class='btn btn-default' href='<?php echo base_url('article/details/'.$product['product_id']) ?>'> Continuer mes achats </a>
												</div>
												<div class="modal-body">
													<a class='btn btn-default' href='<?php echo base_url('panier') ?>'> Voir mon panier </a>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>
					<div class="row mb-4">
						<div class="col">
						<div class="tab-pane px-0 py-3 active" id="productDescription">
						<h4>Description du produit </h4>
							<p>Vesum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>
						</div>
						</div>
					</div>
					<h4 class="mb-3">Related <strong>Products</strong></h4>
							<div class="products row">
								<div class="col">
									<div class="owl-carousel owl-theme show-nav-title nav-dark mb-0" data-plugin-options="{'loop': false, 'autoplay': false,'items': 4, 'nav': true, 'dots': false, 'margin': 20, 'autoplayHoverPause': true, 'autoHeight': true}">
                            <?php
							if(isset($similarProducts) && !empty($similarProducts))
							{
							 foreach($similarProducts as $product ) {

								
								// $sousCat = $modelSousCat->where('sous_categorie_id', $product['sous_categorie_id'])->first();
								// $category = $modelCat->where('categorie_id', $product['categorie_id'])->first();	

								$sousCat = readGetValueTabByKey($product['sous_categorie_id'] , $listSousCat, 'sous_categorie_id') ;
								// $category = readGetValueTabByKey($product['categorie_id'] , $listCat, 'categorie_id') ;
							
										if(empty($sousCat))
										{
											$sousCat['sous_categorie_name'] = "autres"; 
										}
										if(empty($product['available']))
										{
											$product['available'] = "indisponible";
										}
                                
								?>
								
										<div class="product mb-0">
											<div class="product-thumb-info border-0 mb-3">

												<!-- <div class="product-thumb-info-badges-wrapper">
                                                 <span class="badge badge-ecommerce badge-success">NEW</span>

												</div> -->
												<?php if(session()->get('userID') && $request->getCookie('idUser') || session()->get('userID') ||   $request->getCookie('idUser')) {?>

												<div class="addtocart-btn-wrapper">
													<a id="addPanier" data-article = '<?php echo $product['product_name']; ?>' data-ref="<?php echo $product['product_id'];?>" class="text-decoration-none addtocart-btn" data-tooltip data-original-title="Add to Cart">
														<i class="icons icon-bag"></i>
													</a>
												</div>
												<?php } ?>
											<!--<a href="" class="quick-view text-uppercase font-weight-semibold text-2">
													QUICK VIEW
												</a>-->
												
												<a href="<?php echo base_url("article/details/".$product["product_id"])?>">

													<div class="product-thumb-info-image">
														<img alt="" class="img-fluid" src="/images/default.png">
													</div>
												</a>
											</div>
											<div class="d-flex justify-content-between">
												<div>
													<a href="#" class="d-block text-uppercase text-decoration-none text-color-default text-color-hover-primary line-height-1 text-0 mb-1"><?php echo $sousCat['sous_categorie_name']; ?> </a>
													<h3 class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0"><a href="shop-product-sidebar-right.html" class="text-color-dark text-color-hover-primary"><?php echo $product['product_name']?></a></h3>
											</div>
												<!-- <a href="#" class="text-decoration-none text-color-default text-color-hover-dark text-4"><i class="far fa-heart"></i></a> -->
											</div>
											<div title="Rated 5 out of 5">
												<input type="text" class="d-none" value="5" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'default', 'size':'xs'}">
											</div>
											
											<p class="price text-5 mb-3">
												<span class="sale text-color-dark font-weight-semi-bold"><?php echo $product['price']?> €</span>
												<span class="amount"></span>
											</p>
										</div>
										<?php }}?>

										<?php }else {?>
					 <h4> Oups ce produit est inconnu ...</h4>
					<?php }?>
					</div>					
                   </div>
				</div>
			</div>