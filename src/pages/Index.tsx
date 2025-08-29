import Header from "@/components/Header";
import Hero from "@/components/Hero";
import PropertyCard from "@/components/PropertyCard";
import { Button } from "@/components/ui/button";
import house1 from "@/assets/house1.jpg";
import house2 from "@/assets/house2.jpg";
import house3 from "@/assets/house3.jpg";

// Mock property data with Indian locations and INR prices
const properties = [{
  id: 1,
  image: house1,
  title: "Modern Luxury Villa",
  location: "Bandra West, Mumbai",
  price: 85000,
  bedrooms: 3,
  bathrooms: 2,
  parking: true,
  type: "Villa"
}, {
  id: 2,
  image: house2,
  title: "Elegant Pool Villa",
  location: "Koramangala, Bangalore",
  price: 65000,
  bedrooms: 4,
  bathrooms: 3,
  parking: true,
  type: "Villa"
}, {
  id: 3,
  image: house3,
  title: "Urban Apartment Complex",
  location: "Cyber City, Gurgaon",
  price: 35000,
  bedrooms: 2,
  bathrooms: 2,
  parking: true,
  type: "Apartment"
}, {
  id: 4,
  image: house1,
  title: "Premium Penthouse",
  location: "Anna Nagar, Chennai",
  price: 95000,
  bedrooms: 4,
  bathrooms: 4,
  parking: true,
  type: "Penthouse"
}, {
  id: 5,
  image: house2,
  title: "Family Villa with Garden",
  location: "Jubilee Hills, Hyderabad",
  price: 72000,
  bedrooms: 3,
  bathrooms: 3,
  parking: true,
  type: "Villa"
}, {
  id: 6,
  image: house3,
  title: "Modern Studio Apartment",
  location: "Connaught Place, Delhi",
  price: 45000,
  bedrooms: 1,
  bathrooms: 1,
  parking: false,
  type: "Studio"
}];
const Index = () => {
  return <div className="min-h-screen bg-background">
      <Header />
      <Hero />
      
      {/* Featured Properties Section */}
      <section className="py-16 bg-background">
        <div className="container mx-auto px-4">
          <div className="text-center mb-12">
            <h2 className="text-3xl lg:text-4xl font-bold text-foreground mb-4">
              Featured Properties
            </h2>
            <p className="text-lg text-muted-foreground max-w-2xl mx-auto">
              Explore our handpicked selection of premium rental properties with 3D virtual tours
            </p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {properties.map(property => <PropertyCard key={property.id} {...property} />)}
          </div>

          <div className="text-center mt-12">
            
          </div>
        </div>
      </section>

      {/* Features Section */}
      <section className="py-16 bg-muted/30">
        <div className="container mx-auto px-4">
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div className="text-center p-6">
              <div className="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <span className="text-2xl">🏠</span>
              </div>
              <h3 className="text-xl font-semibold mb-2">3D Virtual Tours</h3>
              <p className="text-muted-foreground">Experience properties with interactive 3D tours before visiting</p>
            </div>
            
            <div className="text-center p-6">
              <div className="w-16 h-16 bg-secondary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <span className="text-2xl">✅</span>
              </div>
              <h3 className="text-xl font-semibold mb-2">Verified Properties</h3>
              <p className="text-muted-foreground">All listings are verified with accurate details and photos</p>
            </div>
            
            <div className="text-center p-6">
              <div className="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <span className="text-2xl">💬</span>
              </div>
              <h3 className="text-xl font-semibold mb-2">24/7 Support</h3>
              <p className="text-muted-foreground">Get help anytime with our dedicated customer support team</p>
            </div>
          </div>
        </div>
      </section>

      {/* Footer */}
      <footer className="bg-foreground text-background py-12">
        <div className="container mx-auto px-4">
          <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
              <h4 className="text-lg font-semibold mb-4">RentHome</h4>
              <p className="text-background/80 text-sm">
                Your trusted partner in finding the perfect rental home across India.
              </p>
            </div>
            <div>
              <h5 className="font-medium mb-3">For Tenants</h5>
              <ul className="space-y-2 text-sm text-background/80">
                <li>Search Properties</li>
                <li>Virtual Tours</li>
                <li>Rent Calculator</li>
                <li>Area Guide</li>
              </ul>
            </div>
            <div>
              <h5 className="font-medium mb-3">For Owners</h5>
              <ul className="space-y-2 text-sm text-background/80">
                <li>List Property</li>
                <li>Tenant Verification</li>
                <li>Rent Agreement</li>
                <li>Property Management</li>
              </ul>
            </div>
            <div>
              <h5 className="font-medium mb-3">Support</h5>
              <ul className="space-y-2 text-sm text-background/80">
                <li>Help Center</li>
                <li>Contact Us</li>
                <li>Terms & Conditions</li>
                <li>Privacy Policy</li>
              </ul>
            </div>
          </div>
          <div className="border-t border-background/20 mt-8 pt-8 text-center text-sm text-background/80">
            © 2024 RentHome. All rights reserved.
          </div>
        </div>
      </footer>
    </div>;
};
export default Index;