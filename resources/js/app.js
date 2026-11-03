import './bootstrap';

// Mobile sidebar toggle
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay?.classList.toggle('hidden');
        });
    }
    
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', () => {
            sidebar?.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });
    }

    // Service card selection
    const serviceCards = document.querySelectorAll('[data-service]');
    serviceCards.forEach(card => {
        card.addEventListener('click', () => {
            serviceCards.forEach(c => c.classList.remove('selected'));
            card.classList.add('selected');
            const input = document.getElementById('service_type');
            if (input) input.value = card.dataset.service;
        });
    });

    // Payment option selection
    const paymentOptions = document.querySelectorAll('[data-payment]');
    paymentOptions.forEach(opt => {
        opt.addEventListener('click', () => {
            paymentOptions.forEach(p => p.classList.remove('selected'));
            opt.classList.add('selected');
            const input = document.getElementById('payment_method');
            if (input) input.value = opt.dataset.payment;
        });
    });

    // Pickup toggle
    const pickupYes = document.getElementById('pickup_yes');
    const pickupNo = document.getElementById('pickup_no');
    const addressSection = document.getElementById('address_section');

    if (pickupYes && pickupNo && addressSection) {
        pickupYes.addEventListener('change', () => {
            if (pickupYes.checked) {
                addressSection.classList.remove('hidden');
                addressSection.classList.add('animate-slide-up');
            }
        });
        pickupNo.addEventListener('change', () => {
            if (pickupNo.checked) {
                addressSection.classList.add('hidden');
            }
        });
    }

    // Auto dismiss alerts
    setTimeout(() => {
        const alerts = document.querySelectorAll('.auto-dismiss');
        alerts.forEach(alert => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 4000);
});

// Chart helper for admin income
window.initChart = function(canvasId, labels, data) {
    const canvas = document.getElementById(canvasId);
    if (!canvas || typeof Chart === 'undefined') return;
    
    new Chart(canvas, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Pemasukan (Rp)',
                data: data,
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#2563eb',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: (ctx) => 'Rp ' + ctx.raw.toLocaleString('id-ID')
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0,0,0,0.05)' },
                    ticks: {
                        callback: (val) => 'Rp ' + val.toLocaleString('id-ID')
                    }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
};
