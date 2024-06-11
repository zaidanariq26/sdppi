// Feather Icon
feather.replace();

// Sidebar
const xBtn = document.querySelector(".x-btn");
const justifyBtn = document.querySelector(".justify-btn");
const sidebar = document.querySelector("#sidebar");

justifyBtn.addEventListener("click", (e) => {
	sidebar.classList.toggle("sidebar-active");
	e.preventDefault;
});
xBtn.addEventListener("click", (e) => {
	sidebar.classList.remove("sidebar-active");
	e.preventDefault;
});

document.addEventListener("click", (e) => {
	if (!sidebar.contains(e.target) && !justifyBtn.contains(e.target)) {
		sidebar.classList.remove("sidebar-active");
		e.preventDefault;
	}
});

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
