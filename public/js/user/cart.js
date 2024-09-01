/**
 * Represents an item in the cart.
 * @class
 */
class CartItem {
    constructor(id, name, price, quantity = 1) {
        Object.assign(this, { id, name, price, quantity });
    }

    increaseQuantity(amount = 1,maxQuantity=100) {
        if(this.quantity >= maxQuantity ){
            this.quantity = maxQuantity;
        }
        else{
            this.quantity += amount
        }
    }

    decreaseQuantity(amount = 1) {
        this.quantity = Math.max(0, this.quantity - amount);
    }

    getTotalPrice() {
        return this.price * this.quantity;
    }
}

/**
 * Represents a shopping cart.
 * @class
 */
class Cart {
    constructor() {
        this.items = this.loadCart();
        this.badgeElement = document.getElementById('cart-badge');
        this.totalPriceElement = document.getElementById('cart-total');
        this.refreshUI();
    }

    addItem(item) {
        const existingItem = this.findItem(item.id);
        existingItem ? existingItem.increaseQuantity(item.quantity) : this.items.push(item);
        this.updateCartState(item.id);
    }

    increaseQuantity(itemId,max) {
        const item = this.findItem(itemId);
        if (item) {
            item.increaseQuantity(1,max);
            this.updateCartState(itemId);
        }
    }

    decreaseQuantity(itemId) {
        const item = this.findItem(itemId);
        if (item) {
            item.decreaseQuantity();
            item.quantity === 0 ? this.removeItem(itemId) : this.updateCartState(itemId);
        }
    }

    removeItem(itemId) {
        this.items = this.items.filter(item => item.id !== itemId);
        this.updateCartState(itemId);
    }

    clearCart() {
        this.items = [];
        this.saveCart();
        this.refreshUI();
        this.updateCartBadge();
    }

    getTotalPrice() {
        return this.items.reduce((total, item) => total + item.getTotalPrice(), 0).toFixed(2);
    }

    loadCart() {
        const cartData = localStorage.getItem('cart');
        return cartData ? JSON.parse(cartData).map(item => new CartItem(...Object.values(item))) : [];
    }

    saveCart() {
        this.checkCartIsEmpty();
        localStorage.setItem('cart', JSON.stringify(this.items));
    }

    updateCartBadge() {
        if (this.badgeElement) {
            this.badgeElement.textContent = this.items.length;
        }
    }

    displayTotal() {
        this.checkCartIsEmpty();
        if (this.totalPriceElement) {
            this.totalPriceElement.textContent = this.getTotalPrice();
        }
    }

    checkCartIsEmpty()
    {
        this.items.length === 0 ?
            $("#checkout-btn").prop('disabled', true)
           : $("#checkout-btn").prop('disabled', false);
    }


    updateButtonState(productId, isInCart) {
        const button = document.querySelector(`[data-product-id="${productId}"]`);
        if (button) {
            button.classList.toggle('!bg-green-400', !isInCart);
            button.classList.toggle('!bg-red-400', isInCart);
        }
    }

    findItem(itemId) {
        return this.items.find(item => item.id === itemId);
    }

    updateCartState(itemId) {
        this.saveCart();
        this.updateCartBadge();
        this.updateButtonState(itemId, this.isItemInCart(itemId));
        this.displayTotal();
    }

    isItemInCart(itemId) {
        return this.items.some(item => item.id === itemId);
    }

    refreshUI() {
        this.updateCartBadge();
        this.displayTotal();
    }
}
