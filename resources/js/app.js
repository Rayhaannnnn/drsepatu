import './bootstrap';

// Mobile sidebar toggle & close handlers
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');
    
    function closeSidebar() {
        sidebar?.classList.add('-translate-x-full');
        sidebarOverlay?.classList.add('hidden');
    }

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay?.classList.toggle('hidden');
        });
    }
    
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeSidebar);
    }

    if (sidebarCloseBtn) {
        sidebarCloseBtn.addEventListener('click', closeSidebar);
    }

    // Auto dismiss alerts
    setTimeout(() => {
        const alerts = document.querySelectorAll('.auto-dismiss');
        alerts.forEach(alert => {
            alert.style.transition = 'opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1), transform 0.5s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-8px)';
            setTimeout(() => alert.remove(), 500);
        });
    }, 4500);
});

// Modern Confirmation Modal Helper using SweetAlert2
window.confirmAction = function(options) {
    const defaults = {
        title: 'Apakah Anda Yakin?',
        text: 'Tindakan ini tidak dapat dibatalkan.',
        icon: 'warning',
        confirmButtonText: 'Ya, Lanjutkan',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#e11d48',
        isDanger: true,
        onConfirm: () => {}
    };
    
    const config = Object.assign({}, defaults, options);
    
    if (typeof Swal !== 'undefined') {
        return Swal.fire({
            title: config.title,
            text: config.text,
            icon: config.icon,
            showCancelButton: true,
            confirmButtonColor: config.confirmButtonColor,
            cancelButtonColor: '#64748b',
            confirmButtonText: config.confirmButtonText,
            cancelButtonText: config.cancelButtonText,
            reverseButtons: true,
            focusCancel: config.isDanger,
            buttonsStyling: true,
            customClass: {
                popup: 'swal2-custom-popup',
                title: 'swal2-custom-title',
                htmlContainer: 'swal2-custom-text',
                confirmButton: 'swal2-custom-confirm',
                cancelButton: 'swal2-custom-cancel'
            }
        }).then((result) => {
            if (result.isConfirmed && typeof config.onConfirm === 'function') {
                config.onConfirm();
            }
            return result;
        });
    } else {
        if (confirm(config.text)) {
            if (typeof config.onConfirm === 'function') {
                config.onConfirm();
            }
            return Promise.resolve({ isConfirmed: true });
        }
        return Promise.resolve({ isConfirmed: false });
    }
};

// Global Toast helper using SweetAlert2
window.showToast = function(message, icon = 'success') {
    if (typeof Swal !== 'undefined') {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });
        Toast.fire({
            icon: icon,
            title: message
        });
    }
};

// Global interceptor for all forms with data-confirm
document.addEventListener('submit', function (e) {
    const form = e.target;
    if (!form || !form.getAttribute) return;
    
    const confirmMsg = form.getAttribute('data-confirm');
    if (confirmMsg && !form.dataset.confirmed) {
        e.preventDefault();
        const confirmTitle = form.getAttribute('data-confirm-title') || 'Konfirmasi Tindakan';
        const confirmBtn = form.getAttribute('data-confirm-btn') || 'Ya, Lanjutkan';
        const isDanger = form.getAttribute('data-confirm-danger') !== 'false';
        
        window.confirmAction({
            title: confirmTitle,
            text: confirmMsg,
            icon: isDanger ? 'warning' : 'question',
            confirmButtonText: confirmBtn,
            confirmButtonColor: isDanger ? '#e11d48' : '#1a56db',
            isDanger: isDanger,
            onConfirm: () => {
                form.dataset.confirmed = 'true';
                form.submit();
            }
        });
    }
});

// Modern Chart helper for admin
window.initChart = function(canvasId, labels, data) {
    const canvas = document.getElementById(canvasId);
    if (!canvas || typeof Chart === 'undefined') return;
    
    const ctx = canvas.getContext('2d');
    let gradient = null;
    if (ctx) {
        gradient = ctx.createLinearGradient(0, 0, 0, 260);
        gradient.addColorStop(0, 'rgba(37, 99, 235, 0.35)');
        gradient.addColorStop(1, 'rgba(37, 99, 235, 0.0)');
    }
    
    new Chart(canvas, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Pemasukan (Rp)',
                data: data,
                borderColor: '#2563eb',
                backgroundColor: gradient || 'rgba(37, 99, 235, 0.1)',
                borderWidth: 2.5,
                fill: true,
                tension: 0.38,
                pointBackgroundColor: '#2563eb',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 4.5,
                pointHoverRadius: 6.5,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index',
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0f172a',
                    titleColor: '#94a3b8',
                    bodyColor: '#ffffff',
                    padding: 12,
                    cornerRadius: 10,
                    bodyFont: { weight: 'bold', family: 'Plus Jakarta Sans' },
                    callbacks: {
                        label: (ctx) => ' Rp ' + Number(ctx.raw || 0).toLocaleString('id-ID')
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(226, 232, 240, 0.6)' },
                    ticks: {
                        color: '#64748b',
                        font: { size: 11 },
                        callback: (val) => {
                            if (val >= 1000000) return (val / 1000000) + ' Jt';
                            if (val >= 1000) return (val / 1000) + ' Rb';
                            return val;
                        }
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: {
                        color: '#64748b',
                        font: { size: 11 }
                    }
                }
            }
        }
    });
};
