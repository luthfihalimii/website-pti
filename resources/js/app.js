import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
  const careerNav = document.querySelector('[data-nav-careers]');
  const careerToggle = document.querySelector('[data-nav-careers-toggle]');
  const careerMenu = document.querySelector('[data-nav-careers-menu]');
  const serviceTabsRoot = document.querySelector('[data-services-tabs]');

  if (serviceTabsRoot) {
    const validTabs = ['eprocurement', 'itconsultant', 'business', 'egovernment'];
    const tabButtons = serviceTabsRoot.querySelectorAll('[data-services-tab]');
    const tabPanels = serviceTabsRoot.querySelectorAll('[data-services-panel]');

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

  if (!careerNav || !careerToggle || !careerMenu) {
    return;
  }

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
});
