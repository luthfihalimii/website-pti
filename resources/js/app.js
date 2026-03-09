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
    const tabButtons = serviceTabsRoot.querySelectorAll('[data-services-tab]');
    const tabPanels = document.querySelectorAll('[data-services-panel]');

    const switchServiceTab = (tabName) => {
      tabPanels.forEach((panel) => {
        panel.classList.toggle('hidden', panel.dataset.servicesPanel !== tabName);
      });

      tabButtons.forEach((button) => {
        const isActive = button.dataset.servicesTab === tabName;

        button.classList.toggle('active', isActive);
        button.setAttribute('aria-selected', isActive ? 'true' : 'false');
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
    const openMenu = () => {
      careerMenu.classList.remove('hidden');
      careerToggle.setAttribute('aria-expanded', 'true');
    };

    const closeMenu = () => {
      careerMenu.classList.add('hidden');
      careerToggle.setAttribute('aria-expanded', 'false');
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
    careerNav.addEventListener('mouseleave', closeMenu);

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
});
