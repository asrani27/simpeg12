# SIMPEG Dashboard UI/UX Documentation

## Overview
Modern, professional, and responsive dashboard design for SIMPEG (Sistem Informasi Kepegawaian) built with Laravel and Tailwind CSS.

## Design Features

### Color Scheme
- **Primary Color**: Indigo (#6366f1, #4338ca, #312e81)
- **Secondary Color**: Purple (#a855f7, #7e22ce)
- **Background**: Light Gray (#f9fafb)
- **Cards**: White with soft shadows
- **Text**: Dark Gray (#1f2937) for headings, Medium Gray (#6b7280) for body

### Design Elements
- **Flat modern design** with subtle gradients
- **Rounded corners** (rounded-xl, rounded-2xl, rounded-full)
- **Soft shadows** (shadow-lg, hover:shadow-xl)
- **Consistent spacing** using Tailwind's spacing scale
- **Clear typography** with proper hierarchy
- **Smooth transitions** on hover states
- **Professional iconography** using SVG icons

## File Structure

```
resources/views/
├── layouts/
│   └── dashboard.blade.php    # Main layout with sidebar and header
└── dashboard.blade.php          # Dashboard content page
```

## Components

### 1. Sidebar Navigation
- **Fixed positioning** on mobile, static on desktop
- **Gradient background**: indigo-700 to purple-800
- **Logo and branding** section at top
- **Navigation menu** with icons for:
  - Dashboard
  - Data Pegawai
  - Naik Pangkat
  - Pensiun
  - Cuti
  - Penghargaan
  - Laporan
  - Manajemen User
  - Pengaturan
- **Logout button** at bottom with hover effect (red)
- **Responsive**: Hamburger menu on mobile, full sidebar on desktop

### 2. Header
- **White background** with shadow
- **Page title** on left
- **Mobile menu button** (hamburger)
- **Notification bell** with badge
- **User profile** with avatar and role
- **Responsive**: Adjusts layout for different screen sizes

### 3. Summary Cards
Five cards displaying key metrics:
1. **Total Pegawai** - indigo accent
2. **Pegawai Aktif** - green accent
3. **Pengajuan Naik Pangkat** - yellow accent
4. **Pegawai Mendekati Pensiun** - orange accent
5. **Pengajuan Cuti** - purple accent

**Features:**
- Large numbers with bold typography
- Icon in colored circle
- Trend indicators with arrows
- Hover shadow effect
- Responsive grid (1 col mobile, 2 cols tablet, 5 cols desktop)

### 4. Charts (Chart.js)
Four interactive charts:

#### a. Statistik Pegawai per Golongan
- **Type**: Vertical Bar Chart
- **Data**: Distribution across all golongan (I - IV/c)
- **Color**: Indigo with rounded bars

#### b. Statistik Pegawai per Jabatan
- **Type**: Horizontal Bar Chart
- **Data**: Distribution by eselon and functional positions
- **Color**: Multi-colored bars for each category

#### c. Status Kepegawaian
- **Type**: Doughnut Chart
- **Data**: PNS, PPPK, Honorer, Kontrak
- **Color**: Four distinct colors with 60% cutout

#### d. Distribusi Pendidikan
- **Type**: Pie Chart
- **Data**: SD, SMP, SMA, D3, S1, S2, S3
- **Color**: Seven distinct colors

**Chart Features:**
- Responsive and maintain aspect ratio
- Clean grid lines
- Hover tooltips
- Legend at bottom (for pie/doughnut)
- Dropdown filters for bar charts

### 5. Recent Activities
- **White card** with rounded corners
- **Activity feed** with timestamps
- **Color-coded icons** for different activity types:
  - Green: Approvals
  - Blue: New submissions
  - Yellow: Warnings/Alerts
  - Purple: Awards
- **Hover effects** on activity items
- **"Lihat Semua"** link

### 6. Quick Actions
- **Gradient background**: indigo-600 to purple-700
- **Translucent buttons** with backdrop blur
- **Quick access** to common tasks:
  - Tambah Pegawai Baru
  - Buat Laporan
  - Ajukan Cuti
  - Proses Naik Pangkat
  - Lihat Notifikasi
- **Hover effects** with increased opacity

## Responsive Design

### Breakpoints
- **Mobile** (< 640px): Single column, hidden sidebar with overlay
- **Tablet** (640px - 1024px): 2 columns for cards, partial sidebar
- **Desktop** (>= 1024px): Full sidebar, optimal layout

### Mobile Adaptations
- Collapsible sidebar with hamburger menu
- Stacked grid layouts
- Hidden user details (show only avatar)
- Touch-friendly button sizes
- Scrollable charts if needed

## Customization Guide

### Changing Colors
Edit the color classes in the dashboard files:

```php
// Primary color (currently indigo)
class="bg-indigo-600"
class="text-indigo-600"
class="border-indigo-500"

// Secondary color (currently purple)
class="bg-purple-700"
class="text-purple-600"
```

### Modifying Card Data
Update the numbers and labels in `dashboard.blade.php`:

```php
<p class="text-3xl font-bold text-gray-800">1,234</p>
<p class="text-sm font-medium text-gray-500 mb-1">Total Pegawai</p>
```

### Updating Chart Data
Modify the data arrays in the Chart.js configuration:

```javascript
data: {
    labels: ['I', 'II/a', 'II/b', ...],
    datasets: [{
        data: [45, 78, 92, ...],
    }]
}
```

### Adding New Menu Items
Add to the sidebar navigation in `layouts/dashboard.blade.php`:

```html
<li>
    <a href="#" class="flex items-center px-4 py-3 text-white rounded-lg hover:bg-indigo-600 transition-colors duration-200">
        <svg class="w-5 h-5">...</svg>
        <span class="ml-3 font-medium">Menu Baru</span>
    </a>
</li>
```

## Implementation Notes

### Requirements
- Laravel 10+ (or current version)
- Tailwind CSS (configured via Vite)
- Chart.js (loaded via CDN)
- FontAwesome (optional, for additional icons)

### Route Configuration
Ensure routes are properly set in `routes/web.php`:

```php
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
```

### Controller
The `DashboardController` returns the dashboard view:

```php
public function index()
{
    return view('dashboard');
}
```

### Authentication
The dashboard requires authentication. Ensure your authentication middleware is properly configured.

## Best Practices

1. **Accessibility**
   - Use semantic HTML elements
   - Add `aria-label` attributes to buttons
   - Ensure sufficient color contrast
   - Provide alternative text for images

2. **Performance**
   - Charts are loaded from CDN for simplicity
   - For production, consider bundling Chart.js
   - Use Tailwind's purge configuration to remove unused styles

3. **Security**
   - Always use Laravel's CSRF protection (`@csrf`)
   - Sanitize user input before display
   - Implement proper authorization checks

4. **Maintainability**
   - Keep component structure consistent
   - Use meaningful class names
   - Comment complex sections
   - Follow Laravel and Tailwind conventions

## Future Enhancements

- [ ] Add data filtering and search functionality
- [ ] Implement real-time updates with WebSocket
- [ ] Add export functionality (PDF, Excel)
- [ ] Create additional chart types
- [ ] Implement user preferences (dark mode)
- [ ] Add keyboard shortcuts
- [ ] Create printable versions of reports
- [ ] Implement offline capability with PWA

## Browser Support

- Chrome/Edge (latest)
- Firefox (latest)
- Safari (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Support

For issues or questions:
1. Check Tailwind CSS documentation: https://tailwindcss.com/docs
2. Check Chart.js documentation: https://www.chartjs.org/docs
3. Check Laravel documentation: https://laravel.com/docs

## Credits

- **Design**: Modern flat design inspired by government dashboard standards
- **Icons**: Heroicons (SVG)
- **Charts**: Chart.js library
- **Framework**: Laravel 10+ with Tailwind CSS

---

Created for SIMPEG (Sistem Informasi Kepegawaian)
© {{ date('Y') }} - All rights reserved
