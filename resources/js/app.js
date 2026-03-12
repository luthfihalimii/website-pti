import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
  const careerNav = document.querySelector('[data-nav-careers]');
  const careerToggle = document.querySelector('[data-nav-careers-toggle]');
  const careerMenu = document.querySelector('[data-nav-careers-menu]');
  const mobileNavToggle = document.querySelector('[data-mobile-nav-toggle]');
  const mobileNavMenu = document.querySelector('[data-mobile-nav-menu]');
  const mobileCareersToggle = document.querySelector('[data-mobile-careers-toggle]');
  const mobileCareersMenu = document.querySelector('[data-mobile-careers-menu]');
  const adminSidebarToggle = document.querySelector('[data-admin-sidebar-toggle]');
  const adminSidebar = document.querySelector('[data-admin-sidebar]');
  const adminSidebarBackdrop = document.querySelector('[data-admin-sidebar-backdrop]');
  const serviceTabsRoot = document.querySelector('[data-services-tabs]');

  if (serviceTabsRoot) {
    const validTabs = ['eprocurement', 'itconsultant', 'business', 'egovernment'];
    const tabButtons = Array.from(serviceTabsRoot.querySelectorAll('[data-services-tab]'));
    const tabPanels = Array.from(document.querySelectorAll('[data-services-panel]'));

    const switchServiceTab = (tabName) => {
      tabPanels.forEach((panel) => {
        const isActive = panel.dataset.servicesPanel === tabName;

        panel.classList.toggle('hidden', !isActive);
        panel.hidden = !isActive;
        panel.tabIndex = isActive ? 0 : -1;
      });

      tabButtons.forEach((button) => {
        const isActive = button.dataset.servicesTab === tabName;

        button.classList.toggle('active', isActive);
        button.setAttribute('aria-selected', isActive ? 'true' : 'false');
        button.setAttribute('tabindex', isActive ? '0' : '-1');
      });

      history.replaceState(null, '', `#${tabName}`);
    };

    const loadServiceTabFromHash = () => {
      const hash = window.location.hash.replace('#', '');
      switchServiceTab(validTabs.includes(hash) ? hash : validTabs[0]);
    };

    tabButtons.forEach((button) => {
      button.addEventListener('click', () => {
        switchServiceTab(button.dataset.servicesTab);
      });

      button.addEventListener('keydown', (event) => {
        const currentIndex = tabButtons.indexOf(button);
        let targetIndex = currentIndex;

        switch (event.key) {
          case 'ArrowRight':
          case 'ArrowDown':
            targetIndex = (currentIndex + 1) % tabButtons.length;
            break;
          case 'ArrowLeft':
          case 'ArrowUp':
            targetIndex = (currentIndex - 1 + tabButtons.length) % tabButtons.length;
            break;
          case 'Home':
            targetIndex = 0;
            break;
          case 'End':
            targetIndex = tabButtons.length - 1;
            break;
          default:
            return;
        }

        event.preventDefault();

        const targetButton = tabButtons[targetIndex];
        if (!targetButton) {
          return;
        }

        switchServiceTab(targetButton.dataset.servicesTab);
        targetButton.focus();
      });
    });

    window.addEventListener('hashchange', loadServiceTabFromHash);
    loadServiceTabFromHash();
  }

  if (mobileNavToggle && mobileNavMenu) {
    const closeMobileNav = () => {
      mobileNavMenu.classList.add('hidden');
      mobileNavToggle.setAttribute('aria-expanded', 'false');
    };

    const openMobileNav = () => {
      mobileNavMenu.classList.remove('hidden');
      mobileNavToggle.setAttribute('aria-expanded', 'true');
    };

    mobileNavToggle.addEventListener('click', () => {
      const isExpanded = mobileNavToggle.getAttribute('aria-expanded') === 'true';

      if (isExpanded) {
        closeMobileNav();
        return;
      }

      openMobileNav();
    });

    if (mobileCareersToggle && mobileCareersMenu) {
      mobileCareersToggle.addEventListener('click', () => {
        const isExpanded = mobileCareersToggle.getAttribute('aria-expanded') === 'true';
        mobileCareersToggle.setAttribute('aria-expanded', isExpanded ? 'false' : 'true');
        mobileCareersMenu.classList.toggle('hidden', isExpanded);
      });
    }

    document.addEventListener('click', (event) => {
      if (!(event.target instanceof Node)) {
        return;
      }

      if (!mobileNavMenu.contains(event.target) && !mobileNavToggle.contains(event.target)) {
        closeMobileNav();
      }
    });

    window.addEventListener('resize', () => {
      if (window.innerWidth >= 1024) {
        closeMobileNav();
      }
    });
  }

  if (careerNav && careerToggle && careerMenu) {
    let closeMenuTimer;

    const openMenu = () => {
      window.clearTimeout(closeMenuTimer);
      careerMenu.classList.remove('hidden');
      careerToggle.setAttribute('aria-expanded', 'true');
    };

    const closeMenu = () => {
      window.clearTimeout(closeMenuTimer);
      careerMenu.classList.add('hidden');
      careerToggle.setAttribute('aria-expanded', 'false');
    };

    const scheduleCloseMenu = () => {
      window.clearTimeout(closeMenuTimer);
      closeMenuTimer = window.setTimeout(closeMenu, 140);
    };

    careerToggle.addEventListener('click', () => {
      const isExpanded = careerToggle.getAttribute('aria-expanded') === 'true';

      if (isExpanded) {
        closeMenu();
        return;
      }

      openMenu();
    });

    careerNav.addEventListener('mouseenter', openMenu);
    careerNav.addEventListener('mouseleave', scheduleCloseMenu);
    careerMenu.addEventListener('mouseenter', openMenu);
    careerMenu.addEventListener('mouseleave', scheduleCloseMenu);

    careerNav.addEventListener('focusout', (event) => {
      if (event.relatedTarget instanceof Node && careerNav.contains(event.relatedTarget)) {
        return;
      }

      closeMenu();
    });

    document.addEventListener('click', (event) => {
      if (!(event.target instanceof Node)) {
        return;
      }

      if (!careerNav.contains(event.target)) {
        closeMenu();
      }
    });

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') {
        closeMenu();
        careerToggle.focus();
      }
    });
  }

  if (adminSidebarToggle && adminSidebar && adminSidebarBackdrop) {
    const closeAdminSidebar = () => {
      adminSidebar.classList.add('hidden');
      adminSidebarBackdrop.classList.add('hidden');
      adminSidebarToggle.setAttribute('aria-expanded', 'false');
    };

    const openAdminSidebar = () => {
      adminSidebar.classList.remove('hidden');
      adminSidebarBackdrop.classList.remove('hidden');
      adminSidebarToggle.setAttribute('aria-expanded', 'true');
    };

    adminSidebarToggle.addEventListener('click', () => {
      const isExpanded = adminSidebarToggle.getAttribute('aria-expanded') === 'true';

      if (isExpanded) {
        closeAdminSidebar();
        return;
      }

      openAdminSidebar();
    });

    adminSidebarBackdrop.addEventListener('click', closeAdminSidebar);

    window.addEventListener('resize', () => {
      if (window.innerWidth >= 1024) {
        adminSidebar.classList.remove('hidden');
        adminSidebarBackdrop.classList.add('hidden');
        adminSidebarToggle.setAttribute('aria-expanded', 'false');
        return;
      }

      closeAdminSidebar();
    });
  }

  const clientSwiperElement = document.querySelector('.clientSwiper');

  if (clientSwiperElement && typeof window.Swiper === 'function') {
    const clientSwiper = new window.Swiper('.clientSwiper', {
      loop: true,
      speed: 1200,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      slidesPerView: 1,
    });

    let moveTimeout;

    clientSwiperElement.addEventListener('mousemove', (event) => {
      clearTimeout(moveTimeout);

      moveTimeout = setTimeout(() => {
        const width = clientSwiperElement.offsetWidth;
        const mouseX = event.offsetX;

        if (mouseX < width / 2) {
          clientSwiper.slidePrev();
          return;
        }

        clientSwiper.slideNext();
      }, 600);
    });
  }
});
