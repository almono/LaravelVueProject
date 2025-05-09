<template>
  <div>
    <BNavbar class="px-4 text-light" toggleable="lg" variant="light" pills>
      <BNavbarBrand href="#">Dashboard</BNavbarBrand>
      <BNavbarToggle target="nav-collapse" />
      <BCollapse id="nav-collapse" is-nav>
        <BNavbarNav class="ms-auto mb-2 mb-lg-0">
          <BNavItemDropdown text="Lang" right>
            <BDropdownItem href="#">EN</BDropdownItem>
            <BDropdownItem href="#">ES</BDropdownItem>
            <BDropdownItem href="#">RU</BDropdownItem>
            <BDropdownItem href="#">FA</BDropdownItem>
          </BNavItemDropdown>
          <BNavItemDropdown right>
            <template #button-content>
              <span class="material-icons">
                account_circle
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

<style lang="css" scoped>
.dropdown-toggle::after {
  display: none !important;
}
</style>
  