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
        @item-click="onItemClick">
          <span slot="toggle-icon"><i class="fa fa-arrows-h" aria-hidden="true"></i>
          </span>
          <span slot="dropdown-icon"><i class="fa fa-angle-right" aria-hidden="true"></i>
          </span>
      </sidebar-menu>

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
          title: 'SIWI | ADMIN ',
          rtl:true,
          hiddenOnCollapse: true
        },        
        {
            title: 'Akuntansi',
            icon: 'fa fa-square',
            child: [
                {
                    href: '/akuntansiD3',
                    title: 'D-III Akuntansi'
                },
                {
                    href: '/akuntansiD3-AP',
                    title: 'D-III Akuntansi Alih Program'
                },
                {
                    href: '/akuntansiD4-AP-AKT',
                    title: 'D-IV Akuntansi Alih Program (AKT)'
                },
                {
                    href: '/akuntansiD4-AP-NAKT',
                    title: 'D-IV Akuntansi Alih Program (Non AKT)'
                }
            ]
        },        
        {
            title: 'Pajak',
            icon: 'fa fa-square-o',
            child: [
                {
                    href: '/pajakD3',
                    title: 'D-III Pajak'
                },
                {
                    href: '/pbbD3',
                    title: 'D-III PBB / Penilai'
                },
                {
                    href: '/pajakD3-AP',
                    title: 'D-III Pajak Alih Program'
                },
                {
                    href: '/pajakD1',
                    title: 'D-I Pajak'
                }
            ]
        },     
        {
            title: 'Kepabeanan dan Cukai',
            icon: 'fa fa-circle',
            child: [
                {
                    href: '/beacukaiD3',
                    title: 'D-III Kepabeanan dan Cukai'
                },
                {
                    href: '/beacukaiD3-AP',
                    title: 'D-III Kepabeanan dan Cukai Alih Program'
                },
                {
                    href: '/beacukaiD1',
                    title: 'D-I Kepabeanan dan Cukai'
                }
            ]
        },     
        {
            title: 'Manajemen Keuangan',
            icon: 'fa fa-circle-o',
            child: [
                {
                    href: '/kbnD3',
                    title: 'D-III Kebendaharaan Negara'
                },
                {
                    href: '/mansetD3',
                    title: 'D-III Manajemen Aset'
                },
                {
                    href: '/kbnD3-AP',
                    title: 'D-III Kebendaharaan Negara Alih Program'
                },
                {
                    href: '/kbnD1',
                    title: 'D-I Kebendaharaan Negara'
                }
            ]
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
  font-size:11px;
  padding-left: 48%;
  transition: 0.3s ease;
}
#demo.collapsed {
  padding-left: 1%;
}
#demo.onmobile {
  padding-left: 250%;
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
.v-sidebar-menu{
    background-color: #464646;;
}
// .v-sidebar-menu .vsm--arrow {
//   visibility :0;
// }
</style>
