<?php

namespace App\Controllers;

session_start();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use App\Models\User;

class ProductController
{
    // Pagina principală
    public function home(Request $request, Response $response)
     {
        $products = Product::all();
        ob_start();
        require_once '../views/index.view.php';
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    public function index(Request $request, Response $response, $args)
    {
        // Obține parametrii query (căutare și categorie)
        $query = $request->getQueryParams()['query'] ?? '';
        $categoryId = $request->getQueryParams()['categorie_id'] ?? null;
    
        // Construiește interogarea pentru produse
        $productsQuery = Product::query();
    
        // Filtrează după termenul de căutare (nume produs)
        if (!empty($query)) {
            $productsQuery->where('name', 'like', '%' . $query . '%');
        }
    
        // Filtrează după categorie, dacă a fost selectată
        if (!empty($categoryId)) {
            $productsQuery->where('category_id', $categoryId);
        }
    
        // Adaugă o ordine implicită (opțional)
        $products = $productsQuery->orderBy('name', 'asc')->get();
    
        // Obține toate categoriile pentru dropdown-ul de filtrare
        $categories = Category::all();
    
        // Include view-ul și trimite variabilele necesare
        ob_start();
        require '../views/products/index.view.php';
        $html = ob_get_clean();
    
        // Returnează răspunsul cu conținutul generat
        $response->getBody()->write($html);
        return $response;
    }

    public function create(Request $request, Response $response, $args)
    {
        $categories = Category::all();
        ob_start();
        require '../views/products/create.view.php';
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    public function store(Request $request, Response $response, $args)
    {
        $product = $request->getParsedBody();
       
         // Verifică dacă fișierul imagine a fost încărcat
        $uploadedFiles = $request->getUploadedFiles();
        $image = $uploadedFiles['image'] ?? null;

        if ($image && $image->getError() === UPLOAD_ERR_OK) {
        // Nume unic pentru imagine
        $filename = uniqid() . '_' . $image->getClientFilename();
        $targetPath = '../public/uploads/' . $filename;

        // Mută fișierul în directorul de destinație
        $image->moveTo($targetPath);

        // Adaugă calea imaginii în datele produsului
        $product['image'] = $filename;
        } 
        
        Product::create($product);
        
        return $response
            ->withHeader('Location', '/')
            ->withStatus(302);
    }

    public function edit(Request $request, Response $response, $args)
    {
        $categories = Category::all();
        $product = Product::find($args['id']);
        ob_start();
        require '../views/products/edit.view.php';
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    public function update(Request $request, Response $response, $args)
    {
        // Obține datele trimise prin formular
        $data = $request->getParsedBody();
        
        // Găsește produsul în funcție de ID
        $product = Product::find($args['id']);
        
        // Verificăm dacă s-a trimis o imagine nouă
        $uploadedFiles = $request->getUploadedFiles();
        $image = $uploadedFiles['image'] ?? null;
        
        // Dacă există o imagine nouă, o actualizăm
        if ($image && $image->getError() === UPLOAD_ERR_OK) {
            // Generează un nume unic pentru imagine
            $filename = uniqid() . '_' . $image->getClientFilename();
            $targetPath = '../public/uploads/' . $filename;
            
            // Mută fișierul în directorul de destinație
            $image->moveTo($targetPath);
            
            // Setează noul nume al imaginii
            $product->image = $filename;
        } else {
            // Dacă nu s-a trimis o imagine nouă, păstrăm imaginea curentă
            $product->image = $data['current_image'];
        }
        
        // Actualizăm restul câmpurilor
        $product->fill($data);
        
        // Salvăm produsul actualizat
        $product->save();
        
        return $response
        ->withHeader('Location', '/')
        ->withStatus(302);
    }

    

    public function delete(Request $request, Response $response, $args)
    {
        // Găsește produsul după ID
        $product = Product::find($args['id']);
        
        if ($product) {
            // Șterge fișierul imaginii, dacă există și nu este implicit
            if ($product->image && $product->image !== 'default.png') {
                $imagePath = '../public/uploads/' . $product->image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            
            // Șterge produsul din baza de date
            $product->delete();
        }
    
        // Redirecționează la pagina principală
        return $response
            ->withHeader('Location', '/')
            ->withStatus(302);
    }
    
    
    public function show(Request $request, Response $response, $args)
    {
        $product = Product::find($args['id']);
        if (!$product) {
            return $response->withStatus(404)->write('Produsul nu a fost găsit');
        }
        ob_start();
        require '../views/products/show.view.php'; // Asigură-te că fișierul corect este încărcat
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }
    
}
