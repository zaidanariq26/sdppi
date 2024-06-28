// Feather Icon
feather.replace();

// Menghilangkan alert setelah 5 detik
setTimeout(function () {
	let alert = document.querySelector(".alert");
	if (alert) {
		let bsAlert = new bootstrap.Alert(alert);
		bsAlert.close();
	}
}, 3000);

// Alert Toast
function alertToast(icon, title) {
	const Toast = Swal.mixin({
		toast: true,
		position: "top",
		showConfirmButton: false,
		timer: 2000,
		timerProgressBar: true,
		didOpen: (toast) => {
			toast.onmouseenter = Swal.stopTimer;
			toast.onmouseleave = Swal.resumeTimer;
		},
	});
	Toast.fire({
		icon: icon,
		title: title,
	});
}
