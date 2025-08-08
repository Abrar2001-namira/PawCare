<?php
require_once 'core/Controller.php';
require_once 'config.php';

class ShopController extends Controller
{
    /* grid: /Shop/index or /Shop/index?cat=Food */
    public function index()
    {
        $m   = $this->model('Product');
        $cat = $_GET['cat'] ?? null;

        $this->view('shop/index', [
            'products' => $cat ? $m->byCategory($cat) : $m->all(),
            'cat'      => $cat
        ]);
    }

    /* detail: /Shop/detail?id=7 */
    public function detail()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {                               // no id → go back
            header("Location: ".BASE_URL."/Shop/index"); exit;
        }

        $prod = $this->model('Product')->find($id);
        if (!$prod) {                             // id not found → back
            header("Location: ".BASE_URL."/Shop/index"); exit;
        }

        $this->view('shop/detail', ['prod'=>$prod]);
    }
}
