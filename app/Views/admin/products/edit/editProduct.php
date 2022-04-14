

				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">
				
				    <div class="sidebar-header">
				        <div class="sidebar-toggle d-none d-md-flex" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
				            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
				        </div>
				    </div>
				
				    <div class="nano">
				        <div class="nano-content">
				            <nav id="menu" class="nav-main" role="navigation">
				            
				                <ul class="nav nav-main">
				                    <li>
				                        <a class="nav-link" href="<?php echo base_url('admin') ?>">
				                            <i class="bx bx-home-alt" aria-hidden="true"></i>
				                            <span>Dashboard</span>
				                        </a>                        
				                    </li>
				        				                     
				                        <ul class="nav nav-children">
				                            <li>
				                                <a class="nav-link" href="<?php echo base_url('admin/category')?>">
				                                    - Catégories
				                                </a>
				                            </li>
				                            <li class="nav-active">
				                                <a class="nav-link" href="<?php echo base_url('admin/sousCategory')?>">
				                                    - Sous-catégories
				                                </a>
				                            </li>
											<li class="nav-active">
				                                <a class="nav-link" href="<?php echo base_url('admin/customers')?>">
				                                    - Utilisateurs
				                                </a>
				                            </li>
										
				                        </ul>
				                    </li>
				                   </ul>
								   </nav>
				</aside>
				<!-- end: sidebar -->
				
				<section role="main" class="content-body content-body-modern mt-0">
					
				
               <?php 
			//    	$url = base_url('admin/products/edition');
			   
			//    if( !empty($productEdit['product_id']))
			//    {
			// 	   $url = base_url('admin/products/edition/'.$productEdit["product_id"]);
			//    }
				?>

					<!-- start: page -->
						<form  action='<?php echo base_url('admin/products/edition/'.$productEdit["product_id"]) ?>' method="post"  enctype="multipart/form-data">
							<div class="row">
								<div class="col">
									<section class="card card-modern card-big-info">
										<div class="card-body">
											<div class="row">
											<?php 
         
											$valuesForm = [
											'name'=> "",
											'cat' => "",
											'sousCat' => "",
											'prix' =>"",
											'desc' =>""
											];
      
        								if(isset($productEdit['product_id']) && !empty($productEdit['product_id'])) 
                                       { 
                                        $valuesForm = [
                                           "name"=> $productEdit['product_name'],
                                           'cat' => $productEdit['categorie_id'],
                                           'sousCat' => $productEdit['sous_categorie_id'],
                                           'prix' =>$productEdit['price'],
                                           'desc' =>$productEdit['description']
                                         ];
                                        ?>
										<div class="col-lg col-xl">
										<div class="form-group row align-items-center">
											<div class="col-lg-7 col-xl-6">
												<input type="hidden" class="form-control form-control-modern" name="save" value="update"  />
											</div>
										</div>                  
                                       <?php 
                                       } else {
                                        ?>
                                        <div class="col-lg col-xl">
										<div class="form-group row align-items-center">
											<div class="col-lg-7 col-xl-6">
												<input type="hidden" class="form-control form-control-modern" name="save" value="create"  />
											</div>
										</div>  
                                        <?php 
                                    } 
                                        ?>
										
											<div class="col-lg col-xl">
			
											<div class="card text-center">
												<div class="card-header ">
												<div class="image-frame mb-4">
											<?php if(isset($productEdit['product_id']) && !empty($productEdit['product_id']) && isset($productEdit["main_image"]) && !empty($productEdit["main_image"])){ ?>
												<div class="image-frame-wrapper">
													<a href="<?php echo base_url('admin/products/edition/'.$productEdit['product_id'])?>"> <img src ="<?php echo '/uploads/'.$productEdit["main_image"] ?>"  class="img-fluid" alt="Product Short Name" /></a>
												</div>
												</div>
												<div class="card-body ">
													<a href="#" class="btn btn-danger">Supprimer</a>
												</div>
											</div>
											<?php
											 }
											?>
							  			<?php if(isset($productEdit['product_id']) && !empty($productEdit['product_id']) && !isset($productEdit["main_image"]) && empty($productEdit["main_image"])){ ?>

													<h4 class="card-title"> Ce produit ne contient aucunes images 
													<?php echo($productEdit['main_image']);?>

													</h4>
												
											<?php
											 }
											 ?>
											
												
												</div>
													<div class="form-group row align-items-center mt-4">
														<label class="col-lg-5 col-xl-3 control-label text-lg-right mb-0">Nom du produit</label>
														<div class="col-lg-7 col-xl-6">
															<input type="text" class="form-control form-control-modern" name="name" value="<?php echo $valuesForm['name']; ?>"   />
														</div>
													</div>
											<div class="form-group row">
											
											<label class="col-sm-3 control-label text-sm-right pt-2">Disponibilié <span class=" ">*</span></label>
											<div class="col-lg-5 col-xl-5">
											<div class="row">
											
												<div class="radio-custom radio-primary">
													<input id="awesome" name="available" type="radio"  value='en stock' required  />
													<label for="awesome">En stock</label>
												</div>
												<div class='col-lg-2'></div>
												<div class="radio-custom radio-primary">
												<input id="awesome" name="available" type="radio" value='rupture de stock'   />
												<label for="awesome">Rupture de stock </label>
												</div>
											</div>
											</div>
											</div>
											<?php if(isset($category) && !empty($category)){

											?>
											<div class="form-group row">
											<label class="col-sm-3 control-label text-sm-right pt-2">Quelle Catégorie ?</label>
											<div class="col-lg-7 col-xl-6">
												<select id="company" name="category" class="form-control" title="Please select at least one company"  >
												<option value="">Choisir une Catégorie </option>
											<?php	
												 if(!empty($category))
												 {
												    foreach($category as $cat)
													{
														$selected =($cat['categorie_id'] == $productEdit['categorie_id'])? 'selected': '';

								            ?>
											       	<option value="<?php echo $cat['categorie_id'];?>" <?php echo $selected; ?>><?php echo $cat['categorie_name']; ?></option>
											<?php
												 }
											}
											?>
												</select>
										   </div>
										   </div>
										   <?php }?>
										   
										   <?php if(isset($sousCategory) && !empty($sousCategory)){
											?>
											<div class="form-group row">
											<label class="col-sm-3 control-label text-sm-right pt-2">Quelle Sous-Catégorie ?</label>
											<div class="col-lg-7 col-xl-6">
												<select id="company" name="sousCat" class="form-control" title="Please select at least one company"  >
												<option value="">Choisir une sous-catégorie</option>
											<?php	
												 if(!empty($sousCategory))
												 {
												    foreach($sousCategory as $sousCat)
													{
														$selected =($sousCat['sous_categorie_id'] == $productEdit['sous_categorie_id'])? 'selected': '';
								            ?>
											       	<option value="<?php echo $sousCat['sous_categorie_id'];?>" <?php echo $selected; ?>><?php echo $sousCat['sous_categorie_name']; ?></option>
											<?php
												 }
											}
											?>
												</select>
										   </div>
										   </div>
										   <?php }?>
										   <?php 
										      if(!isset($productEdit['product_id']) && empty($productEdit['product_id'])) 
											  {
										   ?>
										   <div class="form-group row">
											<label class="col-sm-3 control-label text-sm-right pt-2">Image</label>
											<div class="col-lg-7 col-xl-6">
													<div class="form-group row align-items-center">
														<div class="col">
																<input class="form-control dropzone" type="file" id="formFile" name="photo">
															</span>
														</div>
													</div>
												</div>
												</div>
												</div>
												<?php } else { ?>
											<div class="form-group row">
											<label class="col-sm-3 control-label text-sm-right pt-2">Inserer une ou plusieurs images</label>
											<div class="col-lg-7 col-xl-6">
													<div class="form-group row align-items-center">
														<div class="col">
															<div id="dropzone-form-image" data-ref="<?php echo $productEdit['product_id']; ?>" class="dropzone-modern dz-square">
																<span class="dropzone-upload-message text-center">
																<input id="awesome" name="photos[]" type="file" multiple />
																</span>
															</div>
														</div>
													</div>
												</div>
												</div>
												</div>

												<?php }?>
												<br>
												<div class="col-lg col-xl">
													<div class="form-group row align-items-center">
														<label class="col-lg-5 col-xl-3 control-label text-lg-right mb-0">Prix du produit</label>
														<div class="col-lg-7 col-xl-6">
															<input type="number" class="form-control form-control-modern" name="price" value="<?php echo $valuesForm['prix']; ?>"   />
														</div>
													</div>
												
													<div class="form-group row">
														<label class="col-lg-5 col-xl-3 control-label text-lg-right pt-2 mt-1 mb-0"> Description </label>
														<div class="col-lg-7 col-xl-6">
															<textarea class="form-control form-control-modern" name="descrip" rows="6"><?php echo $valuesForm['desc']; ?></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
							</div>
							<div class="row action-buttons">
								<div class="col-12 col-md-auto">
									<button type="submit" class="submit-button btn btn-primary btn-px-4 py-3 d-flex align-items-center font-weight-semibold line-height-1" data-loading-text="Loading...">
										<i class="bx bx-save text-4 mr-2"></i> Sauvegarder
									</button>
								</div>
								<div class="col-12 col-md-auto ml-md-auto mt-3 mt-md-0">
									<a href="#" class="delete-button btn btn-danger btn-px-4 py-3 d-flex align-items-center font-weight-semibold line-height-1">
										<i class="bx bx-trash text-4 mr-2"></i> Delete Product
									</a>
								</div>
							</div>
						</form>
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

	