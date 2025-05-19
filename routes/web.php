<?php
session_start();
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/BundlingController.php';
require_once __DIR__ . '/../controllers/FoodController.php';
require_once __DIR__ . '/../controllers/EventController.php'; // ← Tambahkan ini
require_once __DIR__ . '/../controllers/PromoController.php';
require_once __DIR__ . '/../controllers/ForumController.php';
require_once __DIR__ . '/../controllers/FoodInteractionController.php';
require_once __DIR__ . '/../controllers/WishlistController.php';

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
    $auth->showLogin();
} elseif ($route === 'auth/login' && $method === 'POST') {
    $auth->login();
} elseif ($route === 'auth/register' && $method === 'GET') {
    $auth->showRegister();
} elseif ($route === 'auth/register' && $method === 'POST') {
    $auth->register();
} elseif ($route === 'auth/logout') {
    $auth->logout();
}

// Admin dashboard
elseif ($route === 'admin/dashboard') {
    if (!isset($_SESSION['user'])) {
        header('Location: ?route=auth/login');
        exit;
    }
    include __DIR__ . '/../views/admin/dashboard/index.php';
}
elseif ($route === 'user/dashboard') {
    if (!isset($_SESSION['user'])) {
        header('Location: ?route=auth/login');
        exit;
    }
    include __DIR__ . '/../views/user/dashboard/index.php';
}


// Bundling
elseif ($route === 'admin/bundling') {
    $bundling->index();
} elseif ($route === 'admin/bundling/create') {
    $bundling->create();
} elseif ($route === 'admin/bundling/store' && $method === 'POST') {
    $bundling->store();
} elseif (preg_match('#admin/bundling/edit/(\d+)#', $route, $matches)) {
    $bundling->edit($matches[1]);
} elseif (preg_match('#admin/bundling/update/(\d+)#', $route, $matches) && $method === 'POST') {
    $bundling->update($matches[1]);
} elseif (preg_match('#admin/bundling/delete/(\d+)#', $route, $matches)) {
    $bundling->delete($matches[1]);
} elseif ($route === 'bundling') {
    $bundling->userIndex();
} elseif (preg_match('#bundling/show/(\d+)#', $route, $matches)) {
    $bundling->userShow($matches[1]);
}

elseif ($route === 'user/bundling') {
    $bundling->index();
}elseif ($route === 'user/event') {
    $event->index();
}

// Food
elseif ($route === 'admin/food') {
    $food->index();
} elseif ($route === 'admin/food/create') {
    $food->create();
} elseif ($route === 'admin/food/store' && $method === 'POST') {
    $food->store();
} elseif (preg_match('#admin/food/edit/(\d+)#', $route, $matches)) {
    $food->edit($matches[1]);
} elseif (preg_match('#admin/food/update/(\d+)#', $route, $matches) && $method === 'POST') {
    $food->update($matches[1]);
} elseif (preg_match('#admin/food/delete/(\d+)#', $route, $matches)) {
    $food->delete($matches[1]);
}
//userfood
elseif ($route === 'user/food') {
    $foodInteract->userIndex();
} elseif (preg_match('#^user/food/show/(\d+)$#', $route, $matches)) {
    $id = $matches[1];
    $foodInteract->userShow($id);
} elseif ($route === 'user/food/wishlist') {
    $foodInteract->toggleWishlist();
} elseif ($route === 'user/food/rate') {
    $foodInteract->rate();
} elseif ($route === 'user/food/comment') {
    $foodInteract->comment();
}

//wishlistUser
elseif ($route === 'user/wishlist') {
    $wishlist->index();
} elseif ($route === 'user/wishlist/remove') {
    $wishlist->remove();
}

// 🎉 Event Routes (Admin)
 elseif ($route === 'admin/event') {
    $event->index();
} elseif ($route === 'admin/event/create') {
    $event->create();
} elseif ($route === 'admin/event/store' && $method === 'POST') {
    $event->store();
} elseif (preg_match('#admin/event/edit/(\d+)#', $route, $matches)) {
    $event->edit($matches[1]);
} elseif (preg_match('#admin/event/update/(\d+)#', $route, $matches) && $method === 'POST') {
    $event->update($matches[1]);
} elseif (preg_match('#admin/event/delete/(\d+)#', $route, $matches)) {
    $event->delete($matches[1]);

// 🎉 Event Routes (User)
} elseif ($route === 'event') {
    $event->userIndex();
} elseif (preg_match('#event/show/(\d+)#', $route, $matches)) {
    $event->userShow($matches[1]);

//Promo Routes
// Admin routes
}elseif ($route === 'admin/promo') {
    $promo->index();
} elseif ($route === 'admin/promo/create') {
    $promo->create();
} elseif ($route === 'admin/promo/store' && $method === 'POST') {
    $promo->store();
} elseif (preg_match('#admin/promo/edit/(\d+)#', $route, $matches)) {
    $promo->edit($matches[1]);
} elseif (preg_match('#admin/promo/update/(\d+)#', $route, $matches) && $method === 'POST') {
    $promo->update($matches[1]);
} elseif (preg_match('#admin/promo/delete/(\d+)#', $route, $matches)) {
    $promo->delete($matches[1]);
}

// User routes
elseif ($route === 'user/promo') {
    $promo->index();
} 

//Forum chattt
elseif ($route === 'user/forum') {
    $forum->userIndex();
} elseif ($route === 'admin/forum') {
    // cek session role admin
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        die('Akses hanya untuk admin.');
    }
    $forum->adminIndex();
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
