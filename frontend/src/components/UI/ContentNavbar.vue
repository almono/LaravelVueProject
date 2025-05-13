<template>
  <div>
    <BNavbar class="px-4 py-3 text-light" toggleable="lg" variant="light">
      <BNavbarBrand href="#">Dashboard</BNavbarBrand>
      <BNavbarToggle target="nav-collapse" />
      <BCollapse id="nav-collapse" is-nav>
        <BNavbarNav class="ms-auto mb-2 mb-lg-0">
          <LanguageIcon />
          <BNavItemDropdown class="navbar-dropdown" text="Notifications" right>
            <template #button-content>
              <span class="material-icons">
                notifications
              </span>
            </template>
          </BNavItemDropdown>
          <BNavItemDropdown class="navbar-dropdown" right>
            <template #button-content>
              <span class="material-icons">
                person
              </span>
            </template>
            <BDropdownItem href="#">Profile</BDropdownItem>
            <BDropdownItem href="#">Sign Out</BDropdownItem>
          </BNavItemDropdown>
        </BNavbarNav>
      </BCollapse>
    </BNavbar>
  </div>
</template>

<script setup>
import LanguageIcon from './Navbar/LanguageIcon.vue';
</script>

<script>
export default {
  name: "ContentNavbar",
  methods: {
    toggleSidebar() {
      this.$sidebar.displaySidebar(!this.$sidebar.showSidebar);
    },
  },
};
</script>

<style lang="css">
.navbar-dropdown {
  border-radius: 0px !important;
  display: flex !important;
  align-items: center !important;
}
.navbar-dropdown > div > button {
  display: flex !important;
  padding: 0px 10px 0px 10px !important;
}
.navbar-dropdown > div > ul {
  border-radius: 0px !important;
  top: 5px !important;
}
.navbar-dropdown > div > button::after {
  display: none !important;
}
</style>
  