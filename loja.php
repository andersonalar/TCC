<?php
session_start();

// Inicializar carrinho se não existir
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Produtos de exemplo

 $products = [
    1 => [
        'id' => 1,
        'name' => 'Camiseta Básica',
        'price' => 59.90,
        'image' => 'camisa.jpg',
        'description' => 'Camiseta básica 100% algodão, confortável e versátil.'
    ],
    2 => [
        'id' => 2,
        'name' => 'Bermuda verde',
        'price' => 29.90,
        'image' => 'bermuda.jpg',
        'description' => 'bermuda verde, tecido de alta qualidade.'
    ],
    3 => [
        'id' => 3,
        'name' => 'Bermuda cinza',
        'price' => 29.90,
        'image' => 'bermuda2.webp',
        'description' => 'bermuda cinza, perfeito para o verão.'
    ],
    4 => [
        'id' => 4,
        'name' => 'Jaqueta',
        'price' => 199.90,
        'image' => 'jaqueta.jpg',
        'description' => 'jaqueta elegante preta.'
    ]
];

// Processar ações do carrinho
if ($_POST['action'] ?? '' === 'add_to_cart') {
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    
    if (isset($products[$product_id])) {
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] += $quantity;
        } else {
            $_SESSION['cart'][$product_id] = $quantity;
        }
    }
}

if ($_POST['action'] ?? '' === 'remove_from_cart') {
    $product_id = (int)$_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
}

if ($_POST['action'] ?? '' === 'update_cart') {
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    
    if ($quantity > 0) {
        $_SESSION['cart'][$product_id] = $quantity;
    } else {
        unset($_SESSION['cart'][$product_id]);
    }
}

// Calcular total do carrinho
function getCartTotal($cart, $products) {
    $total = 0;
    foreach ($cart as $product_id => $quantity) {
        if (isset($products[$product_id])) {
            $total += $products[$product_id]['price'] * $quantity;
        }
    }
    return $total;
}

// Processar pagamento
$payment_processed = false;
$payment_method = '';
$order_id = '';

if ($_POST['action'] ?? '' === 'process_payment') {
    $payment_method = $_POST['payment_method'] ?? '';
    $order_id = 'ORD-' . date('YmdHis') . '-' . rand(1000, 9999);
    
    if ($payment_method === 'credit_card') {
        // Aqui você integraria com um gateway de pagamento real
        // Por enquanto, simular aprovação
        $payment_processed = true;
    } elseif ($payment_method === 'pix') {
        // Gerar código PIX (simulado)
        $payment_processed = true;
    }
    
    if ($payment_processed) {
        $_SESSION['cart'] = []; // Limpar carrinho após pagamento
    }
}

$cart_total = getCartTotal($_SESSION['cart'], $products);
$cart_count = array_sum($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Store - Sua Loja de Roupas Online</title>
    <style>
        :root {
            --gradients-bg-2: linear-gradient(122deg, #ece3ec 10.89%, #D9DFC9 90.9%);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            background: var(--gradients-bg-2);
            min-height: 100vh;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            margin-bottom: 2rem;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #553c9a;
            text-decoration: none;
        }
        
        .cart-info {
            background: #553c9a;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .cart-info:hover {
            background: #4a3086;
            transform: translateY(-2px);
        }
        
        .success-message {
            background: #10b981;
            color: white;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        
        .product-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }
        
        .product-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 1rem;
        }
        
        .product-name {
            font-size: 1.3rem;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }
        
        .product-price {
            font-size: 1.5rem;
            color: #553c9a;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        
        .product-description {
            color: #666;
            margin-bottom: 1.5rem;
        }
        
        .add-to-cart-form {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        .quantity-input {
            width: 60px;
            padding: 8px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            text-align: center;
        }
        
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background: #553c9a;
            color: white;
        }
        
        .btn-primary:hover {
            background: #4a3086;
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            background: #e2e8f0;
            color: #4a5568;
        }
        
        .btn-secondary:hover {
            background: #cbd5e0;
        }
        
        .btn-success {
            background: #10b981;
            color: white;
        }
        
        .btn-danger {
            background: #ef4444;
            color: white;
        }
        
        .cart-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }
        
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .cart-item:last-child {
            border-bottom: none;
        }
        
        .cart-total {
            font-size: 1.5rem;
            font-weight: bold;
            color: #553c9a;
            text-align: right;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 2px solid #553c9a;
        }
        
        .checkout-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }
        
        .payment-methods {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .payment-method {
            border: 2px solid #e2e8f0;
            border-radius: 15px;
            padding: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .payment-method:hover {
            border-color: #553c9a;
            background: rgba(85, 60, 154, 0.05);
        }
        
        .payment-method.selected {
            border-color: #553c9a;
            background: rgba(85, 60, 154, 0.1);
        }
        
        .form-group {
            margin-bottom: 1rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #2d3748;
        }
        
        .form-input 
{            width: 100%;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #553c9a;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1rem;
        }
        
        .qr-code {
            text-align: center;
            padding: 2rem;
        }
        
        .qr-code img {
            width: 200px;
            height: 200px;
            border: 2px solid #553c9a;
            border-radius: 15px;
        }
        
        .pix-info {
            background: #f0f9ff;
            border: 1px solid #0ea5e9;
            border-radius: 10px;
            padding: 1rem;
            margin-top: 1rem;
        }
        
        .hidden {
            display: none;
        }
        
        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: 1fr;
            }
            
            .payment-methods {
                grid-template-columns: 1fr;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .header-content {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <a href="?" class="logo">Sistema de gerenciamento de salão de beleza-loja</a>
            <a href="#cart" class="cart-info">
                Carrinho (<?php echo $cart_count; ?>) - R$ <?php echo number_format($cart_total, 2, ',', '.'); ?>
            </a>
        </div>
    </header>

    <div class="container">
        <?php if ($payment_processed): ?>
            <div class="success-message">
                <h2>✅ Pagamento Processado com Sucesso!</h2>
                <p>Pedido #<?php echo $order_id; ?> - Método: <?php echo $payment_method === 'credit_card' ? 'Cartão de Crédito' : 'PIX'; ?></p>
                <p>Obrigado pela sua compra! Você receberá um email de confirmação em breve.</p>
            </div>
        <?php endif; ?>


        <h2>Nossos Produtos</h2>
        <div class="products-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card">

                    <img src="img/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="product-image">
                    <h3 class="product-name"><?php echo $product['name']; ?></h3>
                    <div class="product-price">R$ <?php echo number_format($product['price'], 2, ',', '.'); ?></div>
                    <p class="product-description"><?php echo $product['description']; ?></p>
                    
                    <form method="POST" class="add-to-cart-form">
                        <input type="hidden" name="action" value="add_to_cart">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <input type="number" name="quantity" value="1" min="1" max="10" class="quantity-input">
                        <button type="submit" class="btn btn-primary">Adicionar ao Carrinho</button>
                    </form>
                </div>
                    

            <?php endforeach; ?>
            <center><a href="index.html">Ir para a página inical</a></center>
        </div>

        <?php if (!empty($_SESSION['cart'])): ?>
            <div id="cart" class="cart-section">
                <h2>Seu Carrinho</h2>
                <?php foreach ($_SESSION['cart'] as $product_id => $quantity): ?>
                    <?php if (isset($products[$product_id])): ?>
                        <?php $product = $products[$product_id]; ?>
                        <div class="cart-item">
                            <div>
                                <strong><?php echo $product['name']; ?></strong><br>
                                R$ <?php echo number_format($product['price'], 2, ',', '.'); ?> x <?php echo $quantity; ?>
                            </div>
                            <div style="display: flex; gap: 10px; align-items: center;">
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="action" value="update_cart">
                                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                    <input type="number" name="quantity" value="<?php echo $quantity; ?>" min="0" max="10" class="quantity-input" onchange="this.form.submit()">
                                </form>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="action" value="remove_from_cart">
                                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                    <button type="submit" class="btn btn-danger">Remover</button>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                
                <div class="cart-total">
                    Total: R$ <?php echo number_format($cart_total, 2, ',', '.'); ?>
                </div>
            </div>

            <div class="checkout-section">
                <h2>Finalizar Compra</h2>
                <form method="POST" id="checkoutForm">
                    <input type="hidden" name="action" value="process_payment">
                    
                    <div class="form-group">
                        <label class="form-label">Informações de Entrega</label>
                        <input type="text" name="name" placeholder="Nome completo" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <input type="email" name="email" placeholder="E-mail" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <input type="text" name="address" placeholder="Endereço completo" class="form-input" required>
                    </div>
                    
                    <div class="form-row">
                        <input type="text" name="city" placeholder="Cidade" class="form-input" required>
                        <input type="text" name="cep" placeholder="CEP" class="form-input" required>
                    </div>

                    <h3>Método de Pagamento</h3>
                    <div class="payment-methods">
                        <div class="payment-method" onclick="selectPayment('credit_card')">
                            <input type="radio" name="payment_method" value="credit_card" id="credit_card" style="margin-right: 10px;">
                            <label for="credit_card">
                                <strong>💳 Cartão de Crédito</strong><br>
                                <small>Pagamento seguro e instantâneo</small>
                            </label>
                        </div>
                        
                        <div class="payment-method" onclick="selectPayment('pix')">
                            <input type="radio" name="payment_method" value="pix" id="pix" style="margin-right: 10px;">
                            <label for="pix">
                                <strong>📱 PIX</strong><br>
                                <small>Transferência instantânea</small>
                            </label>
                        </div>
                    </div>

                    <div id="credit_card_form" class="hidden" style="margin-top: 2rem;">
                        <h4>Dados do Cartão</h4>
                        <div class="form-group">
                            <input type="text" name="card_number" placeholder="Número do cartão" class="form-input" maxlength="19">
                        </div>
                        <div class="form-row">
                            <input type="text" name="card_name" placeholder="Nome no cartão" class="form-input">
                            <input type="text" name="card_cvv" placeholder="CVV" class="form-input" maxlength="3">
                        </div>
                        <div class="form-row">
                            <input type="text" name="card_expiry" placeholder="MM/AA" class="form-input" maxlength="5">
                            <select name="installments" class="form-input">
                                <option value="1">À vista</option>
                                <option value="2">2x sem juros</option>
                                <option value="3">3x sem juros</option>
                                <option value="6">6x com juros</option>
                                <option value="12">12x com juros</option>
                            </select>
                        </div>
                    </div>

                    <div id="pix_form" class="hidden" style="margin-top: 2rem;">
                        <div class="qr-code">
                            <h4>Escaneie o QR Code</h4>
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=00020126580014BR.GOV.BCB.PIX0136<?php echo uniqid(); ?>5204000053039865802BR5925Fashion Store6009SAO PAULO62070503***6304" alt="QR Code PIX">
                            <div class="pix-info">
                                <strong>Código PIX:</strong><br>
                                <code><?php echo uniqid() . '-' . date('YmdHis'); ?></code><br>
                                <small>Valor: R$ <?php echo number_format($cart_total, 2, ',', '.'); ?></small>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success" style="width: 100%; margin-top: 2rem; font-size: 1.2rem;">
                        Finalizar Compra - R$ <?php echo number_format($cart_total, 2, ',', '.'); ?>
                    </button>
                </form>
            </div>
        <?php else: ?>
            <div class="cart-section">
                <h2>Seu carrinho está vazio</h2>
                <p>Adicione alguns produtos incríveis ao seu carrinho para continuar!</p>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function selectPayment(method) {
            // Marcar o radio button
            document.getElementById(method).checked = true;
            
            // Remover classe selected de todos
            document.querySelectorAll('.payment-method').forEach(el => {
                el.classList.remove('selected');
            });
            
            // Adicionar classe selected ao clicado
            event.currentTarget.classList.add('selected');
            
            // Mostrar/esconder formulários
            document.getElementById('credit_card_form').classList.add('hidden');
            document.getElementById('pix_form').classList.add('hidden');
            
            if (method === 'credit_card') {
                document.getElementById('credit_card_form').classList.remove('hidden');
            } else if (method === 'pix') {
                document.getElementById('pix_form').classList.remove('hidden');
            }
        }
        
        // Máscara para número do cartão
        document.addEventListener('input', function(e) {
            if (e.target.name === 'card_number') {
                let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
                let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
                e.target.value = formattedValue;
            }
            
            if (e.target.name === 'card_expiry') {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length >= 2) {
                    value = value.substring(0, 2) + '/' + value.substring(2, 4);
                }
                e.target.value = value;
            }
            
            if (e.target.name === 'card_cvv') {
                e.target.value = e.target.value.replace(/\D/g, '');
            }
        });
        
        // Validação do formulário
        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
            if (!paymentMethod) {
                e.preventDefault();
                alert('Por favor, selecione um método de pagamento');
                return;
            }
            
            if (paymentMethod.value === 'credit_card') {
                const cardNumber = document.querySelector('input[name="card_number"]').value;
                const cardName = document.querySelector('input[name="card_name"]').value;
                const cardCvv = document.querySelector('input[name="card_cvv"]').value;
                const cardExpiry = document.querySelector('input[name="card_expiry"]').value;
                
                if (!cardNumber || !cardName || !cardCvv || !cardExpiry) {
                    e.preventDefault();
                    alert('Por favor, preencha todos os dados do cartão');
                    return;
                }
            }
        });
    </script>
</body>
</html>