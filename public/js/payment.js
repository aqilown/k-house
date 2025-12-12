// Format Card Number
document.getElementById('card_number').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
    let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
    e.target.value = formattedValue;
});

// Format CVV
document.getElementById('cvv').addEventListener('input', function(e) {
    e.target.value = e.target.value.replace(/[^0-9]/gi, '').slice(0, 3);
});

// Format Expiry Date
document.getElementById('expiry').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
    
    if (value.length >= 2) {
        value = value.slice(0, 2) + ' / ' + value.slice(2, 4);
    }
    
    e.target.value = value;
});

// Form Validation
document.getElementById('paymentForm').addEventListener('submit', function(e) {
    let isValid = true;
    
    // Validate Card Number (16 digits)
    const cardNumber = document.getElementById('card_number').value.replace(/\s+/g, '');
    if (cardNumber.length !== 16) {
        alert('Kart numarası 16 haneli olmalıdır');
        isValid = false;
    }
    
    // Validate CVV (3 digits)
    const cvv = document.getElementById('cvv').value;
    if (cvv.length !== 3) {
        alert('CVV 3 haneli olmalıdır');
        isValid = false;
    }
    
    // Validate Expiry
    const expiry = document.getElementById('expiry').value.replace(/\s+/g, '').replace(/\//g, '');
    if (expiry.length !== 4) {
        alert('Son kullanım tarihi formatı hatalı (AA/YY)');
        isValid = false;
    }
    
    if (!isValid) {
        e.preventDefault();
    }
});