// SIDEBAR DROPDOWN
const allDropdown = document.querySelectorAll('#sidebar .side-dropdown');
const sidebar = document.getElementById('sidebar');
const sidebarOverlay = document.getElementById('sidebar-overlay');
const toggleSidebarBtn = document.querySelector('nav .toggle-sidebar');

// Debug untuk memastikan elemen ditemukan
console.log('Sidebar:', sidebar);
console.log('Sidebar Overlay:', sidebarOverlay);
console.log('Toggle Button:', toggleSidebarBtn);

allDropdown.forEach(item=> {
	const a = item.parentElement.querySelector('a:first-child');
	a.addEventListener('click', function (e) {
		e.preventDefault();

		if(!this.classList.contains('active')) {
			allDropdown.forEach(i=> {
				const aLink = i.parentElement.querySelector('a:first-child');

				aLink.classList.remove('active');
				i.classList.remove('show');
			})
		}

		this.classList.toggle('active');
		item.classList.toggle('show');
	})
})





// SIDEBAR COLLAPSE
const toggleSidebar = document.querySelector('nav .toggle-sidebar');
const allSideDivider = document.querySelectorAll('#sidebar .divider');

// Ensure mobile sidebar works on page load
document.addEventListener('DOMContentLoaded', function() {
	console.log('DOM fully loaded');
	
	if(sidebar && toggleSidebar) {
		console.log('Sidebar and toggle button found');
		
		// Make sure toggle button is properly initialized
		toggleSidebar.addEventListener('click', function (e) {
			e.preventDefault();
			console.log('Toggle sidebar clicked');
			
			if(window.innerWidth <= 768) {
				console.log('Mobile view detected, toggling sidebar class');
				sidebar.classList.toggle('show'); // For mobile
				
				console.log('Sidebar has show class:', sidebar.classList.contains('show'));
				
				// Show or hide overlay when sidebar toggles on mobile
				if(sidebarOverlay) {
					if(sidebar.classList.contains('show')) {
						sidebarOverlay.classList.remove('d-none');
						setTimeout(() => {
							sidebarOverlay.classList.add('show');
						}, 10);
						document.body.style.overflow = 'hidden'; // Prevent scrolling
					} else {
						sidebarOverlay.classList.remove('show');
						setTimeout(() => {
							sidebarOverlay.classList.add('d-none');
						}, 300); // Match CSS transition time
						document.body.style.overflow = ''; // Restore scrolling
					}
				}
			} else {
				sidebar.classList.toggle('hide'); // For desktop (original code)
				
				if(sidebar.classList.contains('hide')) {
					allSideDivider.forEach(item=> {
						item.textContent = '-'
					})
					
					allDropdown.forEach(item=> {
						const a = item.parentElement.querySelector('a:first-child');
						a.classList.remove('active');
						item.classList.remove('show');
					})
				} else {
					allSideDivider.forEach(item=> {
						item.textContent = item.dataset.text;
					})
				}
			}
		});
	} else {
		console.error('Sidebar or toggle button not found!');
		console.log('Sidebar:', sidebar);
		console.log('Toggle Button:', toggleSidebar);
	}
	
	// Hide sidebar when overlay is clicked
	if(sidebarOverlay) {
		sidebarOverlay.addEventListener('click', function() {
			if(sidebar) {
				sidebar.classList.remove('show');
			}
			this.classList.remove('show');
			setTimeout(() => {
				this.classList.add('d-none');
			}, 300);
			document.body.style.overflow = ''; // Restore scrolling
		});
	}
});

// Window resize handler
window.addEventListener('resize', function() {
	if(window.innerWidth > 768 && sidebarOverlay) {
		sidebarOverlay.classList.remove('show');
		sidebarOverlay.classList.add('d-none');
		document.body.style.overflow = '';
	}
});

// PROFILE DROPDOWN
const profile = document.querySelector('nav .profile');
const imgProfile = profile.querySelector('img');
const dropdownProfile = profile.querySelector('.profile-link');

imgProfile.addEventListener('click', function () {
	dropdownProfile.classList.toggle('show');
})




// MENU
const allMenu = document.querySelectorAll('main .content-data .head .menu');

allMenu.forEach(item=> {
	const icon = item.querySelector('.icon');
	const menuLink = item.querySelector('.menu-link');

	icon.addEventListener('click', function () {
		menuLink.classList.toggle('show');
	})
})



window.addEventListener('click', function (e) {
	if(e.target !== imgProfile) {
		if(e.target !== dropdownProfile) {
			if(dropdownProfile.classList.contains('show')) {
				dropdownProfile.classList.remove('show');
			}
		}
	}

	allMenu.forEach(item=> {
		const icon = item.querySelector('.icon');
		const menuLink = item.querySelector('.menu-link');

		if(e.target !== icon) {
			if(e.target !== menuLink) {
				if (menuLink.classList.contains('show')) {
					menuLink.classList.remove('show')
				}
			}
		}
	})
})





// PROGRESSBAR
const allProgress = document.querySelectorAll('main .card .progress');

allProgress.forEach(item=> {
	item.style.setProperty('--value', item.dataset.value)
})






// APEXCHART
var options = {
  series: [{
  name: 'series1',
  data: [31, 40, 28, 51, 42, 109, 100]
}, {
  name: 'series2',
  data: [11, 32, 45, 32, 34, 52, 41]
}],
  chart: {
  height: 350,
  type: 'area'
},
dataLabels: {
  enabled: false
},
stroke: {
  curve: 'smooth'
},
xaxis: {
  type: 'datetime',
  categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
},
tooltip: {
  x: {
    format: 'dd/MM/yy HH:mm'
  },
},
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();