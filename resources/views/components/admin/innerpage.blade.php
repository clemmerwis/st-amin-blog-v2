<div class="container-fluid p-0">

    <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

    <div class="row">      
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Name</h5>
                </div>
                <div class="card-body">
                    <v-text-field
                        v-model="record.name"
                        name="name"
                        clearable
                        :rules="[rules.required]"
                        required
                    ></v-text-field>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Slug</h5>
                </div>
                <div class="card-body">
                    <v-text-field
                        v-model="record.slug"
                        name="slug"
                        clearable
                        :rules="[rules.required]"
                        required
                    ></v-text-field>
                </div>
            </div>
        </div>
    </div>

</div>
