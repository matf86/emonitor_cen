<template>
<div>
    <el-row>
        <span>Dane dla dnia:</span>
        <el-date-picker
                v-model="date"
                type="date"
                placeholder="Wybierz date"
                format="yyyy-MM-dd"
                @change="fetchProducts">
        </el-date-picker>
    </el-row>
    <el-row style="margin: 15px 0;">
        <el-col :xs="24" :sm="24" :md="10" :lg="10" style="margin: 5px 0;"> 
          <el-checkbox-group v-model="checkedTypes" size="small" @change='setProductsList'>
            <el-checkbox v-for="type in types" :label="type" :key="type">{{type}}</el-checkbox>
          </el-checkbox-group>
        </el-col> 
        <el-col :xs="24" :sm="24" :md="14" :lg="14" style="margin: 5px 0;"> 
                <el-autocomplete
                  class="inline-input"
                  v-model="searchInput"
                  :fetch-suggestions="querySearch"
                  placeholder="Znajdź produkt..."
                  :triggerOnFocus="true"
                  size="large"
                  @select="showProduct"
                  @input="resetData">
                  <template slot="append"><i class="el-icon-search"></i></template>
                </el-autocomplete>
        </el-col> 
    </el-row>
    <el-row>
      <el-table
        :data="productsList"
        style="width: 100%"
        empty-text="Brak danch..."
        @sort-change='sortProducts'>
        <el-table-column
          fixed
          sortable="custom"
          prop="product"
          label="Produkt"
          min-width="120">
        </el-table-column>
        <el-table-column
          sortable
          prop="origin"
          label="Pochodzenie"
          min-width="150">
        </el-table-column>
        <el-table-column
          prop="package"
          label="Ilość">
        </el-table-column>
        <el-table-column
          sortable
          prop="price_min"
          label="Cena min"
          min-width="120">
        </el-table-column>
        <el-table-column
          sortable
          prop="price_max"
          label="Cena max"
          min-width="120">
        </el-table-column>
      </el-table>
   </el-row>
   <el-row v-show="total > pageSize">
       <el-pagination
          @current-change= 'handleCurrentChange'   
          :current-page="currentPage"
          :page-size="pageSize"
          layout="prev, pager, next"
          :total="total">
        </el-pagination>
    </el-row>
</div>
</template>

<script>

    export default {
        props: ['products'],
        data() {
            return {
                date: this.products[0]['date'],
                data: this.products,
                slug: this.products[0]['slug'],
                types: [],
                checkedTypes: [],
                searchInput:'',
                productsNames: [],
                pageSize: 10,
                currentPage: 1
            }
        },
        computed: {
            total() {
                return this.data.length; 
            },
            productsList() {
              let from = this.pageSize * (this.currentPage - 1);
              let to = from + this.pageSize;
              return this.data.slice(from, to);
            }
        },
        methods: {
            fetchProducts(date) {
               axios.get('/offers/'+this.slug, { params:
                    {
                        date: date
                    }
                }).then(response => {
                   this.data = response.data;
                }).catch(error => {
                    console.log(error.response.data);
                })
            },
            querySearch(queryString, cb) {
                let query = queryString.trim().toLowerCase();
                let products = this.productsNames;
                let results = query ? this.createFilter(query) : products;

                cb(results);
            },
            createFilter(query) {
               return this.productsNames.filter(product => 
                    product.value.toLowerCase().includes(query)
                );
            },
            loadProductsNames() {
                let uniqeProductList = _.uniq(_.map(this.data, 'product'));

                return uniqeProductList.map(item => {
                        return {'value': item};
                });
            },
            loadProductsTypes() {
                return _.uniq(_.map(this.data, 'type'));
            },
            handleCurrentChange(currentPage) {
              this.currentPage = currentPage;
            },
            sortProducts(column) {
                this.data.sort((a, b) => {
                  if (a[column.prop] > b[column.prop]) {
                    return 1
                  } else if (a[column.prop] < b[column.prop]) {
                    return -1
                  } else {
                    return 0
                  }
                })
                if (column.order === 'descending') {
                  this.data.reverse()
                }
            },
            filterProductsByType() {
              return this.products.filter(product => 
                  _.includes(this.checkedTypes, product.type)              
              )
            },
            setProductsList() {
              this.data = this.filterProductsByType();
              this.searchInput = '';
            },
            showProduct(item) {

              let filteredProducts = this.filterProductsByType();

              let product = filteredProducts.filter(element => 
                  _.includes(item.value, element.product)              
              )

              if(product.length > 0) {
                return this.data = product;
              }

             return noData('Brak wybranego produktu.'); 
            },
            resetData(item) {
              if(!item) {
                this.data = this.filterProductsByType();
              }
            }
        },
        mounted() {
           this.productsNames = this.loadProductsNames();
           this.types = this.loadProductsTypes();
           this.checkedTypes = this.loadProductsTypes();
        }
    }
</script>
