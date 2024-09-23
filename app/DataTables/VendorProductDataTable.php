<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query){
                $editBtn = "<a href='".route('vendor.products.edit', $query->id)."' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='".route('vendor.products.destroy', $query->id)."' class='btn btn-danger delete-item'><i class='fas fa-trash-alt'></i></a>";
                // $moreBtn = '<div class="dropdown dropleft d-inline">
                //                 <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                //                     <i class="fas fa-cog"></i>
                //                 </button>
                //                 <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                //                     <a class="dropdown-item has-icon" href="'.route('admin.products-image-gallery.index', ['product' => $query->id]).'"><i class="far fa-images"></i>Image Gallery</a>
                //                     <a class="dropdown-item has-icon" href="'.route('admin.products-variant.index', ['product' => $query->id]).'"><i class="far fa-file"></i> Variants </a>
                //                 </div>      
                //             </div>';

                $moreBtn = '<div class="btn-group dropstart" style="margin-left: 4px">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item has-icon" href="'.route('vendor.products-image-gallery.index', ['product' => $query->id]).'"><i class="far fa-images"></i>Image Gallery</a></li>
                                    <li><a class="dropdown-item has-icon" href="'.route('vendor.products-variant.index', ['product' => $query->id]).'"><i class="far fa-file"></i> Variants </a></li>
                                </ul>
                            </div>';
                return $editBtn.$deleteBtn.$moreBtn; 
            })
            ->addColumn('image', function($query){
                return $img = "<img src='".asset($query->thumb_image)."' width='150px'></img>";
            })
            ->addColumn('type', function($query){
                switch ($query->product_type){
                    case 'new_arrival':
                            return '<i class="badge bg-success">New Arrival</i>';
                        break;
    
                    case 'featured_product':
                            return '<i class="badge bg-warning">Featured Product</i>';
                        break;

                    case 'top_product':
                            return '<i class="badge bg-info">Top Product</i>';
                        break;

                    case 'best_product':
                            return '<i class="badge bg-danger">Best Product</i>';
                        break;
                    default:
                            return '<i class="badge bg-dark">None</i>';
                        break;
                }
            })
            ->addColumn('status', function($query){
                if ($query->status == 1){
                    // $button = '<label class="custom-switch mt-2">
                    //                 <input type="checkbox" checked name="custom-switch-checkbox" data-id="'.$query->id.'" class="custom-switch-input change-status">
                    //                 <span class="custom-switch-indicator"></span>
                    //             </label>';
                    $button = '<div class="form-check form-switch">
                                    <input data-id="'.$query->id.'" class="form-check-input change-status" type="checkbox" checked id="flexSwitchCheckDefault">
                                </div>';
                }else{
                    // $button = '<label class="custom-switch mt-2">
                    //                 <input type="checkbox" name="custom-switch-checkbox" data-id="'.$query->id.'" class="custom-switch-input change-status">
                    //                 <span class="custom-switch-indicator"></span>
                    //             </label>';
                    $button = '<div class="form-check form-switch">
                                    <input data-id="'.$query->id.'" class="form-check-input change-status" type="checkbox" id="flexSwitchCheckDefault">
                                </div>';
                }
    
                return $button;
            })
            ->addColumn('approved', function($query){
                if($query->is_approved === 1){
                    return '<i class="badge bg-success">Approved</i>';
                }else{
                    return '<i class="badge bg-warning">pending</i>';
                }
            })
            ->rawColumns(['action','image','type','status', 'approved'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('vendor_id', Auth::user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendorproduct-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('image')->width(150),
            Column::make('name'),
            Column::make('price'),
            Column::make('approved'),
            Column::make('type'),
            Column::make('status'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(350)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorProduct_' . date('YmdHis');
    }
}
