// Side nav route
const clickMyListing = () => {
  showPage('#my-listing-page');
  showListingPage('all-listing'); // Add this line to show the default listing page
};

const clickMyProfile = () => {
  showPage('#my-profile-page');
};

const clickMyHistory = () =>{
  showPage('#my-history-page');
};

const clickMyWallet = () =>{
  showPage('#my-wallet-page');
};


const clickMyFavorite = () => {
  showPage('#my-favorite-page');
};

const clickMyAnnouncement = () => {
  showPage('#my-announcement-page');
};


// Side nav active route
const sideNavLinks = document.querySelectorAll('.nav-links');
sideNavLinks.forEach(sideNavLink => {
  sideNavLink.addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector('.active-route')?.classList.remove('active-route');
    sideNavLink.classList.add('active-route');
  });
});

// My Listing active route
const navLinkEls = document.querySelectorAll('.nav-link');
navLinkEls.forEach(navLinkEl => {
  navLinkEl.addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector('.active')?.classList.remove('active');
    this.classList.add('active');
  });
});

// My listing nav route
const showListingPage = (listingId) => {
  const listingTables = document.querySelectorAll('.listing-table');
  listingTables.forEach(table => {
    table.style.display = 'none';
  });

  const selectedTable = document.querySelector(`.${listingId}`);
  if (selectedTable) {
    selectedTable.style.display = 'block';
  }
};

// Handlers for All Listing, Publish, Pending, Expired
const listingLinkEls = document.querySelectorAll('.nav-link[data-target]');
listingLinkEls.forEach(link => {
  link.addEventListener('click', function (e) {
    e.preventDefault();
    const target = this.getAttribute('data-target');
    showListingPage(target);
  });
});

// Function to show/hide main content pages
const showPage = (pageId) => {
  const pages = document.querySelectorAll('.menuItem');
  pages.forEach(page => {
    page.style.display = 'none';
  });

  const selectedPage = document.querySelector(pageId);
  if (selectedPage) {
    selectedPage.style.display = 'block';
  }
};
