<?php
session_start();
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/BundlingController.php';
require_once __DIR__ . '/../controllers/FoodController.php';
require_once __DIR__ . '/../controllers/EventController.php'; 
require_once __DIR__ . '/../controllers/PromoController.php';
require_once __DIR__ . '/../controllers/ForumController.php';
require_once __DIR__ . '/../controllers/FoodInteractionController.php';
require_once __DIR__ . '/../controllers/WishlistController.php';
require_once __DIR__ . '/../controllers/ProfileController.php';
require_once __DIR__ . '/../controllers/DashboardController.php';

$dashboard = new DashboardController();
$profile = new ProfileController();
$wishlist = new WishlistList();
$foodInteract = new FoodInteraction();
$forum = new ForumController();
$promo = new PromoController();
$food = new FoodController();
$auth = new AuthController();
$bundling = new BundlingController();
$event = new EventController(); 

$route = $_GET['route'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];

// Redirect otomatis ke login atau dashboard saat buka root
if ($route === '') {
    if (isset($_SESSION['user'])) {
        header('Location: ?route=user/dashboard');
    } else {
        header('Location: ?route=auth/login');
    }
    exit;
}



// Auth routes
if ($route === 'auth/login' && $method === 'GET') {
    $headTitle = 'Login';
    $auth->showLogin($headTitle);
} elseif ($route === 'auth/login' && $method === 'POST') {
    $auth->login();
} elseif ($route === 'auth/register' && $method === 'GET') {
    $headTitle = 'Register';
    $auth->showRegister($headTitle);
} elseif ($route === 'auth/register' && $method === 'POST') {
    $auth->register();
} elseif ($route === 'auth/logout') {
    $auth->logout();
}

// Admin dashboard
elseif ($route === 'admin/dashboard') {
    // Check if the user is logged in
    if (!isset($_SESSION['user'])) {
        header('Location: ?route=auth/login');
        exit;
    }
    $dashboard->adminIndex();
}
elseif ($route === 'user/dashboard') {
    if (!isset($_SESSION['user'])) {
        header('Location: ?route=auth/login');
        exit;
    }
    $headTitle = 'User Dashboard';
    include __DIR__ . '/../views/user/dashboard/index.php';
}

// Bundling
elseif ($route === 'admin/bundling') {
    $headTitle = 'Manage Bundling';
    $bundling->index($headTitle);
} elseif ($route === 'admin/bundling/create') {
    $headTitle = 'Create Bundling';
    $bundling->create($headTitle);
} elseif ($route === 'admin/bundling/store' && $method === 'POST') {
    $bundling->store();
} elseif (preg_match('#admin/bundling/edit/(\d+)#', $route, $matches)) {
    $headTitle = 'Edit Bundling';
    $bundling->edit($matches[1], $headTitle);
} elseif (preg_match('#admin/bundling/update/(\d+)#', $route, $matches) && $method === 'POST') {
    $bundling->update($matches[1]);
} elseif (preg_match('#admin/bundling/delete/(\d+)#', $route, $matches)) {
    $bundling->delete($matches[1]);
} elseif ($route === 'bundling') {
    $headTitle = 'Bundling List';
    $bundling->userIndex($headTitle);
} elseif (preg_match('#bundling/show/(\d+)#', $route, $matches)) {
    $headTitle = 'Bundling Detail';
    $bundling->userShow($matches[1], $headTitle);
}

elseif ($route === 'user/bundling') {
    $headTitle = 'User Bundling';
    $bundling->index($headTitle);
} elseif ($route === 'user/event') {
    $headTitle = 'User Events';
    $event->index($headTitle);
}

// Food
elseif ($route === 'admin/food') {
    $headTitle = 'Manage Food';
    $food->index($headTitle);
} elseif ($route === 'admin/food/create') {
    $headTitle = 'Create Food';
    $food->create($headTitle);
} elseif ($route === 'admin/food/store' && $method === 'POST') {
    $food->store();
} elseif (preg_match('#admin/food/edit/(\d+)#', $route, $matches)) {
    $headTitle = 'Edit Food Interaction';
    $foodInteract->edit($matches[1], $headTitle);
} elseif (preg_match('#admin/food/update/(\d+)#', $route, $matches) && $method === 'POST') {
    $food->update($matches[1]);
} elseif (preg_match('#admin/food/delete/(\d+)#', $route, $matches)) {
    $headTitle = 'Delete Food';
    $food->delete($matches[1], $headTitle);
}
elseif (preg_match('#admin/review/delete/(\d+)#', $route, $matches)) {
    $foodInteract->deleteReview($matches[1]);
} elseif (preg_match('#admin/wishlist/delete/(\d+)#', $route, $matches)) {
    $foodInteract->deleteWishlist($matches[1]);
}
// user food
elseif ($route === 'user/food') {
    $headTitle = 'User Food List';
    $foodInteract->userIndex($headTitle);
} elseif (preg_match('#^user/food/show/(\d+)$#', $route, $matches)) {
    $headTitle = 'Food Detail';
    $foodInteract->userShow($matches[1], $headTitle);
} elseif ($route === 'user/food/wishlist') {
    $foodInteract->toggleWishlist();
} elseif ($route === 'user/food/rate') {
    $foodInteract->rate();
} elseif ($route === 'user/food/comment') {
    $foodInteract->comment();
}

// wishlist User
elseif ($route === 'user/wishlist') {
    $headTitle = 'My Wishlist';
    $wishlist->index($headTitle);
} elseif ($route === 'user/wishlist/remove') {
    $wishlist->remove();
}

// Event Routes (Admin)
elseif ($route === 'admin/event') {
    $headTitle = 'Manage Events';
    $event->index($headTitle);
} elseif ($route === 'admin/event/create') {
    $headTitle = 'Create Event';
    $event->create($headTitle);
} elseif ($route === 'admin/event/store' && $method === 'POST') {
    $event->store();
} elseif (preg_match('#admin/event/edit/(\d+)#', $route, $matches)) {
    $headTitle = 'Edit Event';
    $event->edit($matches[1], $headTitle);
} elseif (preg_match('#admin/event/update/(\d+)#', $route, $matches) && $method === 'POST') {
    $event->update($matches[1]);
} elseif (preg_match('#admin/event/delete/(\d+)#', $route, $matches)) {
    $event->delete($matches[1]);
}

// Event Routes (User)
elseif ($route === 'event') {
    $headTitle = 'Event List';
    $event->userIndex($headTitle);
} elseif (preg_match('#event/show/(\d+)#', $route, $matches)) {
    $headTitle = 'Event Detail';
    $event->userShow($matches[1], $headTitle);
}

// Admin Promo
elseif ($route === 'admin/promo') {
    $headTitle = 'Manage Promo';
    $promo->index($headTitle);
} elseif ($route === 'admin/promo/create') {
    $headTitle = 'Create Promo';
    $promo->create($headTitle);
} elseif ($route === 'admin/promo/store' && $method === 'POST') {
    $promo->store();
} elseif (preg_match('#admin/promo/edit/(\d+)#', $route, $matches)) {
    $headTitle = 'Edit Promo';
    $promo->edit($matches[1], $headTitle);
} elseif (preg_match('#admin/promo/update/(\d+)#', $route, $matches) && $method === 'POST') {
    $promo->update($matches[1]);
} elseif (preg_match('#admin/promo/delete/(\d+)#', $route, $matches)) {
    $promo->delete($matches[1]);
}

// User Promo
elseif ($route === 'user/promo') {
    $headTitle = 'Promo List';
    $promo->index($headTitle);
} elseif ($route === 'user/profile') {
    $headTitle = 'My Profile';
    $profile->show($headTitle);
} elseif ($route === 'user/profile/update' && $method === 'POST') {
    $profile->update();
} elseif ($route === 'admin/profile') {
    $headTitle = 'My Profile';
    $profile->showAdmin($headTitle);
} elseif ($route === 'admin/profile/update' && $method === 'POST') {
    $profile->updateAdmin();
}

// Forum
elseif ($route === 'user/forum') {
    $headTitle = 'User Forum';
    $forum->userIndex($headTitle);
} elseif ($route === 'admin/forum') {
    // cek session role admin
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        die('Akses hanya untuk admin.');
    }
    $headTitle = 'Admin Forum';
    $forum->adminIndex($headTitle);
} elseif ($route === 'forum/store') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $forum->store();
    }
} elseif (preg_match('/^forum\/delete\/(\d+)$/', $route, $matches)) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        die('Akses hanya untuk admin.');
    }
    $forum->delete($matches[1]);
}
// 404
else {
    http_response_code(404);
    echo "404 Not Found";
}
