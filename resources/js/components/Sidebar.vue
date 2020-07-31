<template>
  <div
    id="demo"
    :class="[{'collapsed' : collapsed}, {'onmobile' : isOnMobile}]"
  >
    <div class="demo">
      <div class="container">
        <router-view />
      </div>
      <sidebar-menu
        :menu="menu"
        :collapsed="collapsed"
        :theme="selectedTheme"
        :show-one-child="true"
        @toggle-collapse="onToggleCollapse"
        @item-click="onItemClick"
      />

      <div
        v-if="isOnMobile && !collapsed"
        class="sidebar-overlay"
        @click="collapsed = true"
      />
    </div>
  </div>
</template>


<script>
const separator = {
  template: `<hr style="border-color: rgba(0, 0, 0, 0.1); margin: 20px;">`
}

export default {
  name: 'Apps',
  data () {
    return {
      menu: [
        {
          header: true,
          title: 'SIWI | ADMIN PAGE',
          rtl:true,
          hiddenOnCollapse: true
        },
        {
          header: false,
          title: 'Akuntansi',
          hiddenOnCollapse: true
        },
        {
          href: '/akuntansiD3',
          title: 'D III Akuntansi',
          icon: 'fa fa-download'
        },
        {
          header: false,
          title: 'Pajak',
          hiddenOnCollapse: true
        },
        {
          href: '/pajakD3',
          title: 'D III Pajak',
          icon: 'fa fa-cogs'
        },
        {
          href: '/pajakD1',
          title: 'D I Pajak',
          icon: 'fa fa-cogs'
        },
        {
          href: '/pbbD3',
          title: 'D III PBB / Penilai',
          icon: 'fa fa-bell'
        },
        {
          header: false,
          title: 'Bea Cukai',
          hiddenOnCollapse: true
        },
        {
          href: '/beacukaiD3',
          title: 'D III Bea Cukai',
          icon: 'fa fa-palette'
        },
        {
          href: '/beacukaiD1',
          title: 'D I Bea Cukai',
          icon: 'fa fa-palette'
        },
        {
          header: false,
          title: 'Manajemen Keuangan',
          hiddenOnCollapse: true
        },
        {
          href: '/kbnD3',
          title: 'D III KBN',
          icon: 'fa fa-cogs'
        },
        {
          href: '/kbnD1',
          title: 'D I KBN',
          icon: 'fa fa-cogs'
        },
        {
          href: '/mansetD3',
          title: 'D III Man Aset',
          icon: 'fa fa-bell'
        },

      ],
      collapsed: false,
      themes: [
        {
          name: 'Default theme',
          input: ''
        },
        {
          name: 'White theme',
          input: 'white-theme'
        }
      ],
      selectedTheme: 'dark-theme',
      isOnMobile: false
    }
  },
  mounted () {
    this.onResize()
    window.addEventListener('resize', this.onResize)
  },
  methods: {
    onToggleCollapse (collapsed) {
      console.log(collapsed)
      this.collapsed = collapsed
    },
    onItemClick (event, item, node) {
      console.log('onItemClick')
      // console.log(event)
      // console.log(item)
      // console.log(node)
    },
    onResize () {
      if (window.innerWidth <= 767) {
        this.isOnMobile = true
        this.collapsed = true
      } else {
        this.isOnMobile = false
        this.collapsed = false
      }
    }
  }
}
</script>

<style lang="scss">
@import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600');

body,
html {
  margin: 0;
  padding: 0;
}

body {
  font-family: 'Source Sans Pro', sans-serif;
  font-size: 18px;
  background-color: #f2f4f7;
  color: #262626;
}

#demo {
  padding-left: 350px;
  margin-left: 300px;
  transition: 0.3s ease;
}
#demo.collapsed {
  padding-left: 10px;
  margin-left: 50px;
}
#demo.onmobile {
  padding-left: 550px;
  margin-left: 300px;
}

.sidebar-overlay {
  position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  background-color: #000;
  opacity: 0.5;
  z-index: 900;
}

.demo {
  padding: 0px;
}

.container {
  max-width: inherit;
}

pre {
  font-family: Consolas, monospace;
  color: #000;
  background: #fff;
  border-radius: 2px;
  padding: 15px;
  line-height: 1.5;
  overflow: auto;
}
.v-sidebar-menu .vsm_expanded{
    max-width: 250px;
}
.v-sidebar-menu .vsm--header {
    font-size: 30px;
    font-weight: 600;
    padding: 10px;
    white-space: nowrap;
    text-transform: uppercase;
}
</style>
