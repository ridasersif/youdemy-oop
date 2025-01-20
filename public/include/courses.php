<?php
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$itemsPerPage = 6;

$pdfCourse = new PdfCourse();

$cours = $pdfCourse->show($currentPage, $itemsPerPage);

$totalItems = $pdfCourse->getTotalItems();
$totalPages = ceil($totalItems / $itemsPerPage);

?>
<section class="courses" id="courses">
				<!--   *** Courses Header Starts ***   -->
				<header class="section-header">
					<div class="header-text">
						<h1>Choose Your Favourite Course</h1>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
					</div>
					<button type="submit" class="courses-btn btn">View All</button>
				</header>
				<!--   *** Courses Header Ends ***   -->
				<!--   *** Courses Contents Starts ***   -->
				<div class="course-contents">

				<?php foreach($cours as $cour): ?>
					<div class="course-card">

						<img alt="" src="<?php echo $cour['phto_interface'] ?>">

						<div class="category">
							<div class="subject"><h3><?php echo $cour['Categorie_nom']?></h3></div>
							<img alt="" src="<?php echo $cour['phto_interface'] ?>">
						</div>
						<h2 class="course-title"><?php echo $cour['description'] ?></h2>
						<div class="course-desc">
						<?php if (isset($_SESSION['user_id'])){ ?>

							<?php if($_SESSION['user_role'] != 2 || $_SESSION['user_role'] !=3){?>
								<?php if($_SESSION['user_role'] == 3){ ?>
									
                                
									<a href="http://localhost/youdemy-oop/app/Controllers/InscriptionController.php?cours_id=<?php echo $cour['id']; ?>&student_id=<?php echo $_SESSION['user_id']; ?>">
										<span><i class="fa-solid fa-user-plus"></i> S'inscrire au cours</span>
									</a>


								 <?php } ?>
							<?php } ?>
						<?php }else{ ?>
							<a href="http://localhost/youdemy-oop/app/Views/auth/register.php"><span><i class="fa-solid fa-user-plus"></i> s'inscrire </span></a>
							<?php } ?>
							<span><i class="fa-solid fa-users"></i> 2154+ Students</span>
						</div>
						<div class="course-ratings">
							<span>4.9 <i class="fa-solid fa-star"></i></span>
							<span><b>165 DH</b><?php echo $cour['price'] ?></span>
						</div>
					</div>
					<?php endforeach ?>
				</div>
				<!-- Pagination -->
<div class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?php echo $i; ?>" class="page-link <?php echo $i == $currentPage ? 'active' : ''; ?>">
            <?php echo $i; ?>
        </a>
    <?php endfor; ?>
</div>

<style>
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        gap: 10px;
    }

    .page-link {
        padding: 10px 15px;
        text-decoration: none;
        border: 1px solid #ddd;
        border-radius: 5px;
        color: #007bff;
    }

    .page-link.active {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }
</style>
				<!--   *** Courses Contents Ends ***   -->
			</section>