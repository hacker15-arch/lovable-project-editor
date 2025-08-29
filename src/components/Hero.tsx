import { useState } from "react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Search, MapPin, Home } from "lucide-react";

const Hero = () => {
  const [location, setLocation] = useState("");
  const [propertyType, setPropertyType] = useState("");
  const [budget, setBudget] = useState("");

  const handleSearch = () => {
    console.log("Search:", { location, propertyType, budget });
  };

  return (
    <section className="relative overflow-hidden bg-gradient-to-br from-primary via-primary-glow to-secondary py-20 lg:py-32">
      <div className="absolute inset-0 bg-black/10"></div>
      
      <div className="container mx-auto px-4 relative z-10">
        <div className="text-center mb-12">
          <h1 className="text-4xl lg:text-6xl font-bold text-white mb-6 animate-float">
            Find Your Perfect
            <span className="block text-secondary">Rental Home</span>
          </h1>
          <p className="text-xl text-white/90 max-w-2xl mx-auto">
            Discover thousands of verified rental properties across India with 3D tours and instant booking
          </p>
        </div>

        {/* Search Form */}
        <div className="max-w-4xl mx-auto bg-white/95 backdrop-blur-md rounded-2xl p-6 shadow-2xl">
          <div className="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <div className="space-y-2">
              <label className="text-sm font-medium text-foreground">Location</label>
              <div className="relative">
                <MapPin className="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-muted-foreground" />
                <Input
                  placeholder="Enter city or area"
                  className="pl-10"
                  value={location}
                  onChange={(e) => setLocation(e.target.value)}
                />
              </div>
            </div>

            <div className="space-y-2">
              <label className="text-sm font-medium text-foreground">Property Type</label>
              <Select value={propertyType} onValueChange={setPropertyType}>
                <SelectTrigger>
                  <SelectValue placeholder="Select type" />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="apartment">Apartment</SelectItem>
                  <SelectItem value="villa">Villa</SelectItem>
                  <SelectItem value="house">Independent House</SelectItem>
                  <SelectItem value="studio">Studio</SelectItem>
                </SelectContent>
              </Select>
            </div>

            <div className="space-y-2">
              <label className="text-sm font-medium text-foreground">Budget</label>
              <Select value={budget} onValueChange={setBudget}>
                <SelectTrigger>
                  <SelectValue placeholder="Select budget" />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="0-15000">₹0 - ₹15,000</SelectItem>
                  <SelectItem value="15000-30000">₹15,000 - ₹30,000</SelectItem>
                  <SelectItem value="30000-50000">₹30,000 - ₹50,000</SelectItem>
                  <SelectItem value="50000+">₹50,000+</SelectItem>
                </SelectContent>
              </Select>
            </div>

            <Button 
              onClick={handleSearch}
              className="hero-btn h-12"
            >
              <Search className="w-4 h-4 mr-2" />
              Search Properties
            </Button>
          </div>
        </div>

        {/* Quick Stats */}
        <div className="grid grid-cols-2 md:grid-cols-4 gap-6 mt-16 text-center">
          <div className="text-white">
            <div className="text-3xl font-bold">10,000+</div>
            <div className="text-white/80">Properties Listed</div>
          </div>
          <div className="text-white">
            <div className="text-3xl font-bold">50+</div>
            <div className="text-white/80">Cities Covered</div>
          </div>
          <div className="text-white">
            <div className="text-3xl font-bold">5,000+</div>
            <div className="text-white/80">Happy Tenants</div>
          </div>
          <div className="text-white">
            <div className="text-3xl font-bold">24/7</div>
            <div className="text-white/80">Support</div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Hero;